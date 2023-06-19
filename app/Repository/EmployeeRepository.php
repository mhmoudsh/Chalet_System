<?php

namespace App\Repository;

use App\Models\CatchReceipt;
use App\Models\Employe;

class EmployeeRepository
{


    public  function  storeData($data){

        Employe::create($data);
    }


    public  function  updateData(Employe $employe , $data){

        $employe->update($data);

    }


    public  function  deleteData($employe,$data){

        $employe->delete($data);

    }
}
