<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Recommendations;
use App\StocksUpdate;
use App\Users;

class UserController extends Controller
{


    public function __construct()
    {
        //
    }

    public function AddUser(request $request){
      $email = $request->only('email')['email'];
      if(count(Users::EMAILCHECK($email)) !== 0){
          return response()->json(['message' => "email already used"], 409)
                           ->header('Access-Control-Allow-Origin', '*');
          }else{
                $params = $request->only(Users::$fields);
                //$email = $datas['email'];
                //$password = Hash::make($datas['password'], ['rounds' => 12]);
                //$params = array('email'=>$email, 'password'=>$password);
                $result = Users::create($params);
                return ($result) ? response()->json(['message' => "sucess"], 201)
                                             ->header('Access-Control-Allow-Origin', '*')
                                 : response()->json(['message' => "failed"], 404)
                                             ->header('Access-Control-Allow-Origin', '*');
          }
      }


        public function userLogin(request $request){
          return Users::Login($request->input('email'), $request->input('password'));
        }


}
