<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employe extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'employes';
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'verification_id',
        'image',];



    public  function  getImageAttribute($q){


        return asset('uploads/employees/'.$q);


    }
    public  function catchReceipts(){

        return $this->hasMany(CatchReceipt::class,'employee_id');
    }

    public  function Receipts(){

        return $this->hasMany(Receipt::class,'employee_id');
    }
}
