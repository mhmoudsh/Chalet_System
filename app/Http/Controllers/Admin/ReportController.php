<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CatchReceipt;
use App\Models\Receipt;
use App\Models\UserSubscription;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function __construct()
    {

        $this->middleware('permission:read_report_receipts', ['only' => ['receiptsReport']]);
        $this->middleware('permission:read_report_catch_receipts', ['only' => ['catchReceiptsReport']]);
        $this->middleware('permission:read_report_expenses', ['only' => ['expensesReport']]);
        $this->middleware('permission:read_report_subscriptions', ['only' => ['subscriptionsReport']]);
    }
    public  function  subscriptionsReport(){

        $data =  UserSubscription::get();
        return view('admin.reports.usersubscriptions_report',compact('data'));

    }
    public  function  expensesReport(){

        $data =  Receipt::where('expenses_id','!=',null)->get();
        return view('admin.reports.expenses_report',compact('data'));

    }
    public  function  receiptsReport(){

        $data =  Receipt::get();
        return view('admin.reports.receipts_report',compact('data'));

    }
    public  function  catchReceiptsReport(){


        $data =  CatchReceipt::get();
        return view('admin.reports.catch_receipts',compact('data'));

    }

}
