<?php

namespace App\Entities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    /****
     * =========================================================================== +
     * The ORM database attributes
     * =========================================================================== +
     */
    public    $timestamps = true;
    protected $table      = 'users';
    protected $fillable   = ['msisdn', 'name', 'access_level'];
    protected $hidden     = ['password', 'remember_token'];
    // protected $casts = ['email_verified_at' => 'datetime'];

    public function setPasswordAttribute($newPassword)
    {
        $this->attributes['password'] = env('PASSWORD__HASH') ? bcrypt($newPassword): $newPassword;
    }
    
}
