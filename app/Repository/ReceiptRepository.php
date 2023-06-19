<?php

namespace App\Repository;

use App\Models\Receipt;

class ReceiptRepository
{


    public  function  storeData($data){

        Receipt::create($data);
return true;
    }
}
