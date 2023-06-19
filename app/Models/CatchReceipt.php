<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatchReceipt extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'number',
        'user_id',
        'employee_id',
        'invoice_id',
        'total',
        'status',
        'date',
        'notes',
    ];

    public  function user(){

        return $this->belongsTo(User::class,'user_id');
    }


    public  function employee(){

        return $this->belongsTo(Employe::class,'employee_id');
    }
}
