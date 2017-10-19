<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{


  public function returnData($data){
    return (empty(json_decode($data))) ? response()->json(['message' => 'failed'], 404)
                                                   ->header('Access-Control-Allow-Origin', '*')
                                       : response()->json(['data' => $data], 200)
                                                   ->header('Access-Control-Allow-Origin', '*') ;
    }


}
