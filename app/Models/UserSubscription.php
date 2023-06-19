<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSubscription extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['user_id',
        'subscription_id',
        'price',
        'duration',
        'status',
        'start_at',
        'end_at',
        'interval',
    ];

    public  function user(){

        return $this->belongsTo(User::class);
    }

    public  function subscription(){

        return $this->belongsTo(Subscription::class);
    }
}
