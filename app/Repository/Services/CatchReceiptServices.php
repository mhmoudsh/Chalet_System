<?php

namespace App\Repository\Services;

use App\Http\Requests\CatchReceiptRequest;
use App\Models\CatchReceipt;
use App\Models\Employe;
use App\Models\Invoice;
use App\Models\User;
use App\Repository\CatchReceiptRepository;
use App\Traits\InvoiceTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatchReceiptServices
{
    private CatchReceiptRepository $catch_receipt_repository;

    public function __construct(CatchReceiptRepository $catch_receipt_repository)
    {

        $this->catch_receipt_repository = $catch_receipt_repository;
    }


    public function getData()
    {

        $data = CatchReceipt::get();
        $users = User::get();
        $employees = Employe::get();

        return ['data' => $data, 'users' => $users, 'employees' => $employees];
    }


    public function findById($id)
    {

        return User::find($id);
    }

    public function saveData($request)
    {

        try {
            DB::beginTransaction();
            $data['number'] = generateUniqueCode();
            $data['user_id'] = $request->user_id;
            $data['invoice_id'] = $request->invoice_id;
            $data['employee_id'] = $request->employee_id;
            $data['total'] = $request->total;
            $data['notes'] = $request->notes;
            $data['date'] = date('Y-m-d');
            $data['status'] = 1;


            $this->catch_receipt_repository->storeData($data);
            $this->calculteBalance($data['user_id'], $data['employee_id'], $data['total']);
//            $this->changeStatusInvoice($data['user_id'], $data['employee_id'], $data['invoice_id'], $data['total']);
            DB::commit();
            session()->flash('success', 'تم اضافة البيانات بنجاح');
            return redirect()->route('catch_receipts.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }

    public function calculteBalance($user_id = null, $employee_id = null, $price = 0)
    {
        if ($user_id != null) {

            $user = $this->findById($user_id);
            $current_balance = $user->balance;
            $total = $current_balance - $price;

            $user->balance = $total;
            $user->save();

            return true;
        }

    }

    public function changeStatusInvoice($user_id = null, $employee_id = null, $invoice_id, $price)
    {
        if ($user_id != null) {
            $invoice = Invoice::where('id', $invoice_id)->whereHas('usersubscription', function ($q) use ($user_id) {

                $q->where('user_id', $user_id);

            })->first();
            $total_of_catch_receipt = CatchReceipt::where('user_id',$user_id)->where('invoice_id',$invoice_id)->sum('total');

            $total_invoice = $invoice->total;

            if ($total_invoice == $total_of_catch_receipt) {

                $invoice->update(['status' => Invoice::STATUS['paid']]);
            } else {

                $invoice->update(['status' => Invoice::STATUS['partial_paid']]);
            }

            return true;


        }
    }


    public  function deleteData($data){

        try {
            $id = $data->id;
            $catch = CatchReceipt::find($id);


            $catch->delete();
            session()->flash('success', 'تم ارشفة البيانات بنجاح');
            return redirect()->route('catch_receipts.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }

    }
}
