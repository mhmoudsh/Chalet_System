<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReceiptRequest;
use App\Models\Employe;
use App\Models\Receipt;
use App\Models\User;
use App\Repository\Services\ReceiptServices;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private ReceiptServices $receipt_services ;

    public function __construct(ReceiptServices $receipt_services)
    {
        $this->receipt_services = $receipt_services ;

        $this->middleware('permission:read_receipts', ['only' => ['index','show']]);
        $this->middleware('permission:create_receipts', ['only' => ['create','store']]);
        $this->middleware('permission:update_receipts', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_receipts', ['only' => ['destroy']]);
    }
    public function index()
    {
        $data =  $this->receipt_services->getData()['data'];
        $users =  $this->receipt_services->getData()['users'];
        $expenses =  $this->receipt_services->getData()['expenses'];
        $employees =  $this->receipt_services->getData()['employees'];
        return view('admin.receipts.index',compact('data','expenses','users','employees'));
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
    public function store(ReceiptRequest $request)
    {
        return $this->receipt_services->saveData($request);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->receipt_services->deleteData($request);
    }
}
