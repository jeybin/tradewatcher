<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Recommendations extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;


    protected $table      = 'recommendations';
    protected $guarded    = ['id'];
    protected $dates      = ['created_at','updated_at'];
    public static $fields = ['company_name','recommended_date','recommended_price',
                             'target_price','stop_loss','time_frame','recommender'];


       public function recommendationId(){
         return Recommendations::hasOne(Recommendations::class,'id');
       }


        public function scopeCheckRecommendation($query, $company_name){
           return $query->where('company_name', $company_name)
                        ->get();
        }


     public function scopeRECOMMENDATIONEXIST($query, $company_name, $recommender, $recommended_date){
        return $query->whereDate('recommended_date',$recommended_date)
                     ->where('company_name', $company_name)
                     ->where('recommender', $recommender)
                     ->get();
     }

     public function scopeID($query, $id){
       return $query->where('id', $id);
     }



}
