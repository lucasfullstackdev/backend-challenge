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

    public function getMsisdnAttribute()
    {
        $msisdn = $this->attributes['msisdn'];
        
        $msisdn = "(" . substr( $msisdn, 0, 3 ) . ") (" . substr($msisdn, 3, 2) . ") " . substr($msisdn, 5, 1) . "." . substr($msisdn, 6, 4) . "-" . substr($msisdn, 10, 4);
    
        return $msisdn;
    }
    
}
