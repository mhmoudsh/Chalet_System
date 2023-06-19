<?php

namespace App\Repository;

use App\Models\CatchReceipt;

class CatchReceiptRepository
{


    public  function  storeData($data){

        CatchReceipt::create($data);

    }
}
