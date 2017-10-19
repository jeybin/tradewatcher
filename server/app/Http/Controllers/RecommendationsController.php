<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Recommendations;
use App\StocksUpdate;
use App\Users;

class RecommendationsController extends Controller
{


    public function __construct()
    {
        //
    }

    public function AddRecommendation(request $request){

      $company_name = $request->only('company_name')['company_name'];
      $recommended_date = $request->only('recommended_date')['recommended_date'];
      $recommender = $request->only('recommender')['recommender'];

      $check = count(Recommendations::RECOMMENDATIONEXIST($company_name,
                                                          $recommender,
                                                          $recommended_date));

      if($check === 0){
          $params = $request->only(Recommendations::$fields);
          $result = Recommendations::create($params);
          return ($result) ? response()->json(['message' => "sucess"], 201)
                                       ->header('Access-Control-Allow-Origin', '*'):
                             response()->json(['message' => "failed"], 404)
                                       ->header('Access-Control-Allow-Origin', '*');
          }else{
              return response()->json(['message' => "data already entered"], 409)
                               ->header('Access-Control-Allow-Origin', '*');
          }

      }




      public function getRecommendationById($recommendation_id){
        return Controller::returnData(Recommendations::findOrFail($recommendation_id)->recommendationId);
      }


      public function getAllRecommendations() {
        return Controller::returnData(Recommendations::all());
      }



}
