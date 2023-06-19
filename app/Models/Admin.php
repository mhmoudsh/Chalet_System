<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin  extends Authenticatable
{
    use HasFactory,SoftDeletes,HasRoles,Notifiable;
    protected  $table = 'admins';
    protected $fillable = [
        'name','email','password','phone','image','roles','address','status'
    ];
    protected $casts = ['roles_name'=>'array'];




}
