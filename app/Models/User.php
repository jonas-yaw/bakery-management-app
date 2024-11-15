<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;
use \M1guelpf\FastLogin\Models\Concerns\CanFastLogin;
//use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;


use Shanmuga\LaravelEntrust\Traits\LaravelEntrustUserTrait;



class User extends Model implements AuthenticatableContract,CanResetPasswordContract
                                    
{

    use SoftDeletes;
    // use HasApiTokens;
    use Authenticatable,  HasFactory;
    use LaravelEntrustUserTrait;
    use CanResetPassword;
    use Notifiable, AuthenticationLoggable;

    protected $table = 'users';

    protected $fillable = [
    'username', 
    'email', 
    'password',
    'fullname',
    'location',
    'usertype',
    'status'
    ];

    protected $hidden = [ 
    'password', 
    'remember_token'];

    protected $casts = [
        'last_password_reset_at' => 'datetime:Y-m-d',
    ];

    public function getFullname()
    {

        if($this->fullname)
        {
            return $this->fullname;
        }
        
        return null;

    }

     public function getNameOrUsername()
    {
            return $this->getFullname() ?: $this->username;
    }

      public function password()
    {

            return $this->password;
    }

    public function allowCredit()
    {

            return $this->allow_credit;
    }

    public function getIntermediary()
    {

            return $this->assigned_agent;

    }


     public function getRole()
    {

            return $this->usertype;
    }

    public function getSignature()
    {

            return $this->signature;

    }

    public function getID()
    {

            return $this->id;

    }

    

      public function getBranch()
    {

            return $this->location;

    }

    public function getEmail()
    {

            return $this->email;

    }

    public function getStatus()
    {
            return $this->status;
    }

    public function sendSmsMessage($message, SmsGatewayInterface $smsGateway)
    {
        try
        {
            $smsGateway->sendSms($message, $this->mobilenumber);
        }
        catch(UndeliveredSmsException $ex)
        {
            // Log message not sent in queue
            throw $ex;
        }
    }

    public function validateForPassportPasswordGrant($password)
    {
        return Hash::check($password, $this->password);
    }




}
