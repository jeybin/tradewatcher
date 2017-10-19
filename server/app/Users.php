<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

use Illuminate\Support\Facades\Hash;

class Users extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;


    protected $table      = 'users';
    protected $guarded    = ['id'];
    protected $dates      = ['created_at','updated_at'];
    public static $fields = ['email','password','type'];

    public function scopeEMAILCHECK($query, $email){
       return $query->where('email', $email)->get();
    }

  public static function Login($email, $password){
    $email_check = Users::where('email', $email)->first();
    if(count($email_check) !== 0){
        $password_check = Users::passwordCheck($email_check->password,$password);
        return ($password_check) ?  response()->json(['message' => 'sucess'], 200)
                                                ->header('Access-Control-Allow-Origin', '*') :
                                      response()->json(['message' => 'failed'], 401)
                                                ->header('Access-Control-Allow-Origin', '*')  ;
    }
  }

  public static function passwordCheck($user_password, $entered_password){
    return Hash::check($entered_password, $user_password);
  }

}
