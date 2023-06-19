<?php

namespace App\Repository;

use App\Models\CatchReceipt;

class InvoiceRepository
{


    public  function  storeData($data){

        CatchReceipt::create($data);

    }
}
