<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Repository\Services\InvoiceServices;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private  $invoice_service ;

    public function __construct(InvoiceServices $invoice_service)
    {
        $this->invoice_service = $invoice_service ;
    }

    public function index()
    {
        $data =  $this->invoice_service->getData();
        return view('admin.invoices.index',compact('data'));
    }

    public function getReceiptInvoices(){

        $data = $this->invoice_service->getReceiptInvoice();
        return view('admin.invoices.receipt',compact('data'));
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
    public function store(Request $request)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
