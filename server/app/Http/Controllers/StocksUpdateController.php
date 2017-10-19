<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Recommendations;
use App\StocksUpdate;
use App\Users;

class StocksUpdateController extends Controller
{

    public function __construct()
    {
        //
    }

    public function DailyStockData(request $request){
      $day = carbon::today()->format('l'); // for finding day name
      $today = Carbon::now();
      if($day !== 'Sunday' || $day !== 'Saturday'){
        $today = explode(' ',$today->toDateTimeString())[0];
        $company_name = $request->only('name')['name'];
        $checkRecommendationByCompanyName = Recommendations::where('company_name',$company_name)->first();
        $recommendation_id = $checkRecommendationByCompanyName->id;
        if(count($checkRecommendationByCompanyName) !== 0){
        $check = count(StocksUpdate::EXIST($today, $recommendation_id));
        if($check === 0){
            $params = $request->only(StocksUpdate::$fields);
            $params = array_add($params,'company_id',$recommendation_id);
            $result = StocksUpdate::create($params);
            return ($result) ? response()->json(['message' => "sucess"], 201)->header('Access-Control-Allow-Origin', '*')
                             : response()->json(['message' => "failed"], 404)->header('Access-Control-Allow-Origin', '*');
            }else{
                return response()->json(['message' => "already entered"], 409)
                                 ->header('Access-Control-Allow-Origin', '*');
              }
            }else{
              return response()->json(['message' => "recommendations not found for this company"], 406)
                               ->header('Access-Control-Allow-Origin', '*');
            }
      }else{
        return response()->json(['message' => "markets are not open"], 444)
                         ->header('Access-Control-Allow-Origin', '*');
      }
    }

    public function getStocksByRecommendationId($recommendation_id){
      return Controller::returnData(StocksUpdate::where('company_id',$recommendation_id)->get());
    }

}
