<?php

namespace App\Entities;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    // use Notifiable;

    /****
     * =========================================================================== +
     * The ORM database attributes
     * =========================================================================== +
     */
    public    $timestamps = true;
    protected $table      = 'users';
    protected $fillable   = ['msisdn', 'name', 'access_level', 'password'];
    protected $hidden     = ['remember_token'];

    /**
     * Realizar a criptografia ou não da senha informada
     * =========================================================================
     */
    public function setPasswordAttribute($newPassword)
    {
        $this->attributes['password'] = env('PASSWORD__HASH') ? bcrypt($newPassword): $newPassword;
    }

    /**
     * Formatar o campo [ msisdn ] para exibição
     * =========================================================================
     */
    public function getFormattedMsisdnAttribute()
    {
        $msisdn = $this->attributes['msisdn'];
        
        $msisdn =substr( $msisdn, 0, 3 ) . " (" . substr($msisdn, 3, 2) . ") " . substr($msisdn, 5, 1) . "." . substr($msisdn, 5, 4) . "-" . substr($msisdn, 9, 4);
    
        return $msisdn;
    }
    
}
