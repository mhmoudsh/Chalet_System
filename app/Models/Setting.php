<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_logo',
        'website_title',
        'phone',
        'phone2',
        'website_email',
        'facebook_link',
        'twitter_link',
        'instagram_link',
        'whatsapp_link',
        'another_link',
        'registration_number',
        'tax_number',
        'address',
        'initial_message',
        'confirm_message',
        'cancel_message',
        'cancel_time',
    ];

    public function getWebsiteLogoAttribute($q)
    {


        return asset('uploads/setting/' . $q);


    }
}
