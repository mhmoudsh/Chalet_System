<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CatchReceipt;
use App\Models\Employe;
use App\Models\Receipt;
use App\Models\Service;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {

//        $users = User::orderByDesc('id')->get();
//        $employees = Employe::orderByDesc('id')->get();
//        $user_subscriptions = UserSubscription::orderByDesc('id')->get();
//        $services = Service::orderByDesc('id')->get();
//        $catch_receipts = CatchReceipt::orderByDesc('id')->get();
//        $receipts = Receipt::orderByDesc('id')->get();
//
//        $statistics_month =  DB::table('user_subscriptions')->select(
//            DB::raw('YEAR(created_at) as year'),
//            DB::raw('MONTH(created_at) as month'),
//            DB::raw('SUM(price) as sum')
//        )->groupBy('month')->get();

        return view('admin.dashboard');
    }
}
