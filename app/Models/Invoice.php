<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory ,SoftDeletes;

    protected $fillable = [
        'number',
        'user_name',
        'user_id',
        'subscription_name',
        'user_subscription_id',
        'duration',
        'total',
        'status',
        'type',
    ];

    public const STATUS=[
        'paid'=>1,
        'partial_paid'=>2,
        'unpaid'=>0,

    ];

    public function usersubscription(){

        return $this->belongsTo(UserSubscription::class,'user_subscription_id');
    }


    public function user(){

        return $this->belongsTo(User::class,'id');
    }
}
