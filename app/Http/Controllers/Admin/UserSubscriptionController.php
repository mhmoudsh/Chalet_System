<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserSubscriptionRequest;
use App\Http\Requests\UserReservationRequest;
use App\Models\Invoice;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;
use App\Repository\Services\UserSubscriptionServices;
use App\Traits\getSubscriptionFunctionsTrait;
use App\Traits\InvoiceTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserSubscriptionController extends Controller
{
    use getSubscriptionFunctionsTrait, InvoiceTrait;

    private UserSubscriptionServices $userSubscriptionServices;

    /**
     * Display a listing of the resource.
     */

    public function __construct(UserSubscriptionServices $userSubscriptionServices )
    {

        $this->userSubscriptionServices = $userSubscriptionServices;

        $this->middleware('permission:read_user_subscriptions', ['only' => ['index','show']]);
        $this->middleware('permission:create_user_subscriptions', ['only' => ['create','store']]);
        $this->middleware('permission:update_user_subscriptions', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_user_subscriptions', ['only' => ['destroy']]);
        $this->middleware('permission:renew_user_subscriptions', ['only' => ['renewSubcription']]);
    }
    public function index()
    {
         $users = $this->userSubscriptionServices->getData()['users'];
         $users_update = $this->userSubscriptionServices->getData()['users_update'];

        $data = $this->userSubscriptionServices->getData()['data'];
        $subscriptions = $this->userSubscriptionServices->getData()['subscriptions'];
        return view('admin.usersubscription.index', compact('data', 'users_update','users', 'subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserReservationRequest $request)
    {
        return $this->userSubscriptionServices->saveData($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserSubscriptionRequest $request)
    {
        return $this->userSubscriptionServices->changeSubscription($request);

    }

    public  function renewSubcription(Request $request){


        return $this->userSubscriptionServices->renewSubscription($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->userSubscriptionServices->deleteData($request);

    }
}
