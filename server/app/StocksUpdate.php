<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class StocksUpdate extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $table      = 'stocks_update';
    protected $guarded    = ['id'];
    protected $dates      = ['created_at','updated_at'];
    public static $fields = ['company_id', 'symbol', 'cmp', 'price_net_change', 'price_net_percentage',
                             'price_status', 'open', 'high', 'low'];


    public function scopeEXIST($query, $date, $recommendation_id){
       return $query->whereDate('created_at', $date)
                    ->Where('company_id',$recommendation_id)->get();
    }

    public function scopeID($query, $id){
      return $query->where('id', $id);
    }

}
