<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialLogins extends Model
{
     protected $table = 'social_logins';
    protected $fillable = [
        'id', 'user_id', 'social_id','provider'
    ];
}
