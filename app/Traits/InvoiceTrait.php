<?php

namespace App\Traits;

use App\Models\CatchReceipt;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;

trait InvoiceTrait
{

    function createInvoice(array $input)
    {

        $data['number'] = generateInvoiceNumber();
        $data['user_name'] = $input['user_name'];
        $data['user_id'] = $input['user_id'];
        $data['subscription_name'] = isset($input['subscription_name']) ? $input['subscription_name'] : null;
        $data['user_subscription_id'] = isset($input['user_subscription_id']) ? $input['user_subscription_id'] : null;
        $data['duration'] = isset($input['duration']) ? $input['duration'] : null;
        $data['total'] = $input['total'];
        $data['status'] = $input['status'];
        $data['type'] = $input['type'];
        $invoice = Invoice::create($data);

    }


    function getInvoicesData(Request $request)
    {

        $id = $request->id;
//        $invoices = Invoice::whereHas('usersubscription', function ($q) use ($id) {
//
//            $q->where('user_id', $id);
//
//        })->orwhereHas('user', function ($q) use ($id) {
//
//            $q->where('id', $id);
//
//        })->Where('status', 0)->orWhere('status', 2)->get();
        $user = User::find($id);
        return response()->json($user->balance);
    }


    function getCatchReceipt(Request $request)
    {
        $user_id = $request->user_id;
        $invoice_id = $request->invoice_id;
        $total_of_catch_receipt = CatchReceipt::where('user_id', $user_id)->where('invoice_id', $invoice_id)->sum('total');


        $invoice = Invoice::Where('id', $invoice_id)->whereHas('usersubscription', function ($q) use ($user_id) {

            $q->where('user_id', $user_id);

        })->first();

        $different_total = $invoice->total - $total_of_catch_receipt;
        return response()->json(['amount_paid' => $total_of_catch_receipt, 'remaining' => $different_total]);
    }

}
