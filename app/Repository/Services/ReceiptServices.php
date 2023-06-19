<?php

namespace App\Repository\Services;

use App\Http\Requests\CatchReceiptRequest;
use App\Models\CatchReceipt;
use App\Models\Employe;
use App\Models\Expenses;
use App\Models\Invoice;
use App\Models\Receipt;
use App\Models\User;
use App\Repository\CatchReceiptRepository;
use App\Repository\ReceiptRepository;
use App\Traits\InvoiceTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiptServices
{
    use InvoiceTrait;
    private ReceiptRepository $receipt_repository;

    public function __construct(ReceiptRepository $receipt_repository)
    {

        $this->receipt_repository = $receipt_repository;
    }


    public function getData()
    {

        $data = Receipt::get();
        $users = User::get();
        $expenses = Expenses::get();
        $employees = Employe::get();

        return ['data' => $data, 'users' => $users, 'employees' => $employees,'expenses'=>$expenses];
    }

    public function findById($id)
    {

        return User::find($id);
    }

    public function saveData($request)
    {

        DB::beginTransaction();
        try {

            $data['number'] = generateUniqueCode();
            $data['user_id'] = $request->user_id;
            $data['invoice_id'] = $request->invoice_id;
            $data['employee_id'] = $request->employee_id;
            $data['expenses_id'] = $request->expenses_id;
            $data['total'] = $request->total;
            $data['notes'] = $request->notes;
            $data['date'] = date('Y-m-d');
            $data['status'] = 1;




            if ($request->user_id !=null){
                $user = User::find($request->user_id);
                $this->calculteBalance($data['user_id'], $data['employee_id'], $data['total']);

            }else {
                $employee = Employe::find($request->employee_id);

            }
//            $invoice_inputs = [
//                'user_name' => isset($user->name) ? $user->name : $employee->name,
//                'user_id' =>  isset($user->id) ? $user->id : $employee->id,
//                'total' =>   $data['total'],
//                'status' => Invoice::STATUS['unpaid'],
//                'type' => '2',//receipt invoices
//            ];
//            $this->createInvoice($invoice_inputs) ;
            $this->receipt_repository->storeData($data);





            DB::commit();
            session()->flash('success', 'تم اضافة البيانات بنجاح');
            return redirect()->route('receipts.index');
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
            $total = $current_balance + $price;

            $user->balance = $total;
            $user->save();

            return true;
        }

    }
    public  function deleteData($data){

        try {
            $id = $data->id;
            $catch = Receipt::find($id);


            $catch->delete();
            session()->flash('success', 'تم ارشفة البيانات بنجاح');
            return redirect()->route('receipts.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }

    }
}
