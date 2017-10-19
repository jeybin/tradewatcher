<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->post('user/add','UserController@AddUser');
$router->post('user/login','UserController@userLogin');

$router->post('stock/add','StocksUpdateController@DailyStockData');

$router->post('recommendations/add','RecommendationsController@AddRecommendation');

$router->get('recommendations/','RecommendationsController@getAllRecommendations');
$router->get('recommendations/{id}','RecommendationsController@getRecommendationById');
$router->get('movement/{name}','RecommendationsController@getMovementByCompanyName');
$router->get('stock/{id}','StocksUpdateController@getStocksById');

$router->get('stock/recommendations/{id}','StocksUpdateController@getStocksByRecommendationId');
