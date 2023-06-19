<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Service;
use App\Models\Subscription;
use App\Repository\Services\SubscriptionServices;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private  $subscription_services ;
    public function __construct(SubscriptionServices $subscription_services)
    {
       $this->subscription_services = $subscription_services;

        $this->middleware('permission:read_subscriptions', ['only' => ['index','show']]);
        $this->middleware('permission:create_subscriptions', ['only' => ['create','store']]);
        $this->middleware('permission:update_subscriptions', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_subscriptions', ['only' => ['destroy']]);
    }

    public function index()
    {
        $services = $this->subscription_services->getData()['services'];
        $data = $this->subscription_services->getData()['data'];
        return view('admin.subscriptions.index',compact('data','services'));
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
    public function store(SubscriptionRequest $request)
    {
       return $this->subscription_services->saveData($request);
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
    public function update(SubscriptionRequest $request)
    {

        return $this->subscription_services->updateData($request,$request->id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->subscription_services->deleteData($request);
    }
}
