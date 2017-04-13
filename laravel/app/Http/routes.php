<?php

//View routes
Route::get('/','orderC@purchaseShow');

Route::get('purchaseHotOrderV','orderC@purchaseHotOrderShow');
Route::get('purchaseHotStarV','orderC@purchaseHotStarShow');
Route::get('purchaseManageV','orderC@purchaseManageShow');
Route::get('purchaseUpdateV','orderC@purchaseUpdateShow');
Route::get('orderNameManageV','orderC@orderNameManageShow');
Route::get('orderMenuManageV','orderC@orderMenuManageShow');

Route::get('restChooseV', 'restaurantC@restChooseShow');
Route::post('restManageV', 'restaurantC@restManageShow');
Route::get('restKindManageV', 'restKindC@restKindManageShow');

Route::get('menuV', 'menuC@menuShow');
Route::get('menuUpdateV', 'menuC@menuUpdateShow');
Route::get('restMenuInsertV', 'menuC@restMenuInsertShow');

Route::get('userEvaluationV', 'evaluationC@userEvaluationShow');
Route::get('hotRestEvaluationV', 'evaluationC@hotRestEvaluationShow');

Route::get('openMealV', 'restaurantC@openMealShow');

Route::get('noRestOpenV','errorC@noRestOpenShow');

//Controller routes
Route::post('action_rmInt', 'menuC@restMenuInsert');
Route::get('action_cInt', 'evaluationC@evaluationInsert');

//login
Route::auth();
Route::get('home', 'HomeController@index');

//Authority
Route::get('noAuthV', 'Controller@AuthUrl');

//test
Route::get('testAJAX_php', 'testC@testShow');
Route::get('testAJAX', 'testC@testShow2');
Route::get('testHTML', 'testC@testHTML');



