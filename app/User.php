<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Lunaweb\EmailVerification\Traits\CanVerifyEmail;
use Lunaweb\EmailVerification\Contracts\CanVerifyEmail as CanVerifyEmailContract;

class User extends Authenticatable implements CanVerifyEmailContract
{
    use Notifiable;
    use CanVerifyEmail;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the email verification notification.
     *
     * @param  string  $token   The verification mail reset token.
     * @param  int  $expiration The verification mail expiration date.
     * @return void
     */
    public function sendEmailVerificationNotification($token, $expiration)
    {
        $this->notify(new MyEmailVerificationNotification($token, $expiration));
    }    
}
