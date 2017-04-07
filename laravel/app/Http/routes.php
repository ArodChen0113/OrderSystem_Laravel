<?php

//View routes
Route::get('/','orderC@purchaseShow');

Route::get('purchaseManageV','orderC@purchaseManageShow');
Route::get('purchaseUpdateV','orderC@purchaseUpdateShow');
Route::get('orderNameManageV','orderC@orderNameManageShow');
Route::get('orderMenuManageV','orderC@orderMenuManageShow');

Route::get('menuV', 'menuC@menuShow');
Route::get('menuUpdateV', 'menuC@menuUpdateShow');
Route::get('restMenuInsertV', 'menuC@restMenuInsertShow');

Route::get('restChooseV', 'restaurantC@restChooseShow');
Route::post('restManageV', 'restaurantC@restManageShow');
Route::get('restKindManageV', 'restKindC@restKindManageShow');

Route::get('openMealV', 'restaurantC@openMealShow');

//Controller routes
Route::post('action_rmInt', 'menuC@restMenuInsert');
Route::post('action_rKInt', 'restKindC@restKindInsert');
Route::post('action_rKUp', 'restKindC@restKindUpdate');
Route::get('action_rKDel', 'restKindC@restKindDel');

Route::post('action_reUp', 'restaurantC@restUpdate');
Route::get('action_reDel', 'restaurantC@restDel');
Route::post('action_openMeal', 'restaurantC@openMealUp');

Route::post('action_meUp', 'menuC@menuUpdate');
Route::get('action_meDel', 'menuC@menuDel');

Route::get('action_pcInt', 'orderC@purchaseInsert');
Route::get('action_pcDel', 'orderC@purchaseDelete');
Route::get('action_orPay', 'orderC@orderPay');

Route::auth();

Route::get('home', 'HomeController@index');

Route::get('testAJAX_php', 'testC@testShow');
Route::get('testAJAX', 'testC@testShow2');

Route::get('testHTML', 'testC@testHTML');



