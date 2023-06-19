<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReservation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id',
        'status',
        'date',
        'interval_id',
        'start_custom_time',
        'end_custom_time',
        'basic_price',
        'manual_price',
        'amount_paid',];

    public  function user(){

        return $this->belongsTo(User::class);
    }


    public  function interval(){

        return $this->belongsTo(Interval::class);
    }



}
