<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
class UserDetails extends Model  implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
	 use Authenticatable, Authorizable, CanResetPassword;
    protected $table = 'users';
    protected $fillable = [
        'name', 'email','password', 'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   
	
	public function sociallogins()
	{
		return $this->hasMany('App\SocialLogins','user_id','id')->get();
	}
}
