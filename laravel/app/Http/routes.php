<?php

//View routes
Route::get('/','orderC@purchaseShow');
Route::get('/1','orderC@purchaseShow1');

Route::get('purchaseManageV','orderC@purchaseManageShow');
Route::get('purchaseUpdateV','orderC@purchaseUpdateShow');
Route::get('orderManageV','orderC@orderManageShow');

Route::get('menuV', 'menuC@menuShow');
Route::get('menuUpdateV', 'menuC@menuUpdateShow');
Route::get('restMenuInsertV', 'menuC@restMenuInsertShow');

Route::get('restChooseV', 'restaurantC@restChooseShow');
Route::post('restManageV', 'restaurantC@restManageShow');
Route::get('restKindManageV', 'restKindC@restKindManageShow');

Route::get('openMealV', 'restaurantC@openMealShow');
Route::get('openMealV2', 'restaurantC@openMealShow2');

//Controller routes
Route::post('action_rmInt', 'menuC@restMenuInsert');
Route::post('action_rKInt', 'restKindC@restKindInsert');
Route::post('action_rKUp', 'restKindC@restKindUpdate');
Route::get('action_rKDel', 'restKindC@restKindDel');
Route::get('action_rKControl1', 'restKindC@restKindControl1');
Route::get('action_rKControl2', 'restKindC@restKindControl2');

Route::post('action_reUp', 'restaurantC@restUpdate');
Route::get('action_reDel', 'restaurantC@restDel');
Route::post('action_openMeal', 'restaurantC@openMealUp');

Route::post('action_meUp', 'menuC@menuUpdate');
Route::get('action_meDel', 'menuC@menuDel');

Route::post('action_pcInt', 'orderC@purchaseInsert');
Route::get('action_pcDel', 'orderC@purchaseDelete');
Route::get('action_orPay', 'orderC@orderPay');




