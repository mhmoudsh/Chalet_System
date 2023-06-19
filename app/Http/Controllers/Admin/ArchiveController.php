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

class ArchiveController extends Controller
{


    public function getEmployees()
    {

        $data = Employe::onlyTrashed()->get();

        return view('admin.archive.employee', compact('data'));
    }

    public function restoreEmployee(Request $request)
    {
        try {


            $id = $request->id;
            $employee = Employe::onlyTrashed()->find($id)->restore();

            session()->flash('success', 'تم استعادة البيانات بنجاح');
            return redirect()->route('admin.get_employeesArchive');

        } catch (\Exception $ex) {

            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }

    public function getUsers()
    {

        $data = User::onlyTrashed()->get();

        return view('admin.archive.user', compact('data'));
    }

    public function restoreUser(Request $request)
    {
        try {

            $id = $request->id;
            $user = User::onlyTrashed()->find($id)->restore();

            session()->flash('success', 'تم استعادة البيانات بنجاح');
            return redirect()->route('admin.get_usersArchive');

        } catch (\Exception $ex) {

            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }

    public function getServices()
    {

        $data = Service::onlyTrashed()->get();

        return view('admin.archive.service', compact('data'));
    }

    public function restoreService(Request $request)
    {
        try {


            $id = $request->id;
            $service = Service::onlyTrashed()->find($id)->restore();
            session()->flash('success', 'تم استعادة البيانات بنجاح');
            return redirect()->route('admin.get_servicesArchive');

        } catch (\Exception $ex) {

            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }

    public function getUserSubscriptions()
    {

        $data = UserSubscription::onlyTrashed()->get();

        return view('admin.archive.subscription', compact('data'));
    }

    public function restoreUserSubscription(Request $request)
    {
        try {
            $id = $request->id;
            $data = UserSubscription::onlyTrashed()->find($id)->restore();

            session()->flash('success', 'تم استعادة البيانات بنجاح');
            return redirect()->route('admin.get_UserSubscriptionArchive');

        } catch (\Exception $ex) {

            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }


    public function getCatchReceipts()
    {

        $data = CatchReceipt::onlyTrashed()->get();

        return view('admin.archive.catch_receipt', compact('data'));
    }

    public function restoreCatchReceipt(Request $request)
    {



        try {
            $id = $request->id;
            $data = CatchReceipt::onlyTrashed()->find($id)->restore();

            session()->flash('success', 'تم استعادة البيانات بنجاح');
            return redirect()->route('admin.getCatchReceiptsArchive');

        } catch (\Exception $ex) {

            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }

    public function getReceipts()
    {

        $data = Receipt::onlyTrashed()->get();

        return view('admin.archive.receipt', compact('data'));
    }

    public function restoreReceipt(Request $request)
    {

        try {
            $id = $request->id;
            $data = Receipt::onlyTrashed()->find($id)->restore();

            session()->flash('success', 'تم استعادة البيانات بنجاح');
            return redirect()->route('admin.getCatchReceiptsArchive');

        } catch (\Exception $ex) {

            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }
}
