<?php

namespace App\Repository;

use App\Models\CatchReceipt;
use App\Models\Service;
use App\Models\Subscription;

class UserSubscriptionRepository
{


    public  function  storeData($data){

        Subscription::create($data);

    }


    public  function  updateData(Subscription $subscription,$data){

        $subscription->update($data);

    }


    public  function  deleteData(Subscription $subscription){

        $subscription->delete();

    }
}
