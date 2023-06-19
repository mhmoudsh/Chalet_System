<?php

use App\Models\Invoice;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderReturn;
use App\Models\Receipt;
use App\Models\SalesOrder;
use App\Models\SupplierStocks;
use Illuminate\Support\Facades\Config;


// function upload file
function uploadFile($folder, $file)
{
  $extension = strtolower($file->extension());
  $filename = time() . rand(100, 999) . '.' . $extension;
  $file->getClientOriginalName = $filename;
  $file->move($folder, $filename);
  return $filename;
}
// function check execute delete or not
function generateUniqueCode()
{

    $characters = '0123456789';
    $charactersNumber = strlen($characters);
    $codeLength = 6;

    $code = '';

    while (strlen($code) < 6) {
        $position = rand(0, $charactersNumber - 1);
        $character = $characters[$position];
        $code = $code.$character;
    }

    if (\App\Models\CatchReceipt::where('number', $code)->exists()) {
        generateUniqueCode();
    }

    if (\App\Models\Receipt::where('number', $code)->exists()) {
        generateUniqueCode();
    }

    return $code;

}


function generateInvoiceNumber(){
    //get last record

    $record = Invoice::latest()->first();


    if (! $record) {
        return '0001';
    }

    $string = preg_replace("/[^0-9\.]/", '', $record->number);

    return sprintf('%04d', $string+1);
}



