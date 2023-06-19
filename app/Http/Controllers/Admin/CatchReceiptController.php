<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CatchReceiptRequest;
use App\Models\CatchReceipt;
use App\Models\Employe;
use App\Models\User;
use App\Repository\Services\CatchReceiptServices;
use App\Traits\InvoiceTrait;
use Illuminate\Http\Request;

class CatchReceiptController extends Controller
{
    use InvoiceTrait;
    /**
     * Display a listing of the resource.
     */
     private CatchReceiptServices $catch_receipt_services ;

    public function __construct(CatchReceiptServices $catch_receipt_services)
    {
        $this->catch_receipt_services = $catch_receipt_services ;
        $this->middleware('permission:read_catch_receipts', ['only' => ['index','show']]);
        $this->middleware('permission:create_catch_receipts', ['only' => ['create','store']]);
        $this->middleware('permission:update_catch_receipts', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_catch_receipts', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data =  $this->catch_receipt_services->getData()['data'];
        $users =  $this->catch_receipt_services->getData()['users'];
        $employees =  $this->catch_receipt_services->getData()['employees'];
        return view('admin.catch_receipts.index',compact('data','users','employees'));
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
    public function store(CatchReceiptRequest $request)
    {

        return $this->catch_receipt_services->saveData($request);

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
        return $this->catch_receipt_services->deleteData($request);
    }
}
