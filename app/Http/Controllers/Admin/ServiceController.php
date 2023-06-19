<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Repository\Services\Services;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private  $services;
    public function __construct(Services $services)
    {
        $this->services = $services;
        $this->middleware('permission:read_services', ['only' => ['index','show']]);
        $this->middleware('permission:create_services', ['only' => ['create','store']]);
        $this->middleware('permission:update_services', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_services', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = $this->services->getData();
        return view('admin.services.index',compact('data'));
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
    public function store(ServiceRequest $request)
    {

        return $this->services->saveData($request);
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
    public function update(ServiceRequest $request, string $id)
    {
     return   $this->services->updateData($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request  $request)
    {

     return   $this->services->deleteData($request);
    }
}
