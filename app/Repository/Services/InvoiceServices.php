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

class InvoiceServices
{
    private CatchReceiptRepository $catch_receipt_repository ;
    public function __construct(CatchReceiptRepository $catch_receipt_repository)
    {

        $this->catch_receipt_repository = $catch_receipt_repository;
    }


    public  function getData(){

        $data = Invoice::where('type',1)->get();

        return $data;
    }
    public  function getReceiptInvoice(){

        $data = Invoice::where('type',2)->get();

        return $data;
    }


    public  function  saveData($request){

        try {
            $data['number'] =generateUniqueCode();
            $data['user_id'] = $request->user_id;
            $data['invoice_id'] = $request->invoice_id;
            $data['employee_id'] = $request->employee_id;
            $data['total'] = $request->total;
            $data['notes'] = $request->notes;
            $data['date'] = date('Y-m-d');
            $data['status'] = 1;


            $this->catch_receipt_repository->storeData($data);


            session()->flash('success','تم اضافة البيانات بنجاح');
            return redirect()->route('catch_receipts.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }
}
