<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'services';
    protected $fillable = ['name','status','image'];

    public  function  getImageAttribute($q){


        return asset('uploads/services/'.$q);


    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class,'service_ids');
    }
}
