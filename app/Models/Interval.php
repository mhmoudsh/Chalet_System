<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interval extends Model
{
    use HasFactory;

    protected $table = 'intervals';
    protected $fillable = ['name',
        'price',
        'start_time',
        'end_time'];
}
