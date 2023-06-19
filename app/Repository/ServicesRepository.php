<?php

namespace App\Repository;

use App\Models\CatchReceipt;
use App\Models\Service;

class ServicesRepository
{


    public  function  storeData($data){

        Service::create($data);

    }


    public  function  updateData(Service $service,$data){

        $service->update($data);

    }


    public  function  deleteData(Service $service){

        $service->delete();

    }
}
