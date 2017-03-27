<?php

//View routes
Route::get('/','orderC@purchaseShow');
//Route::get('/','OrderC@purchaseDetailShow');
Route::get('purchaseManageV','orderC@purchaseManageShow');
Route::get('purchaseUpdateV','orderC@purchaseUpdateShow');
Route::get('orderManageV','orderC@orderManageShow');

Route::get('menuV', 'menuC@menuShow');
Route::get('menuUpdateV', 'menuC@menuUpdateShow');
Route::get('restMenuInsert', 'menuC@restMenuInsertShow');

Route::get('restChooseV', 'restaurantC@restChooseShow');
Route::get('restManageV', 'restaurantC@restManageShow');
Route::get('restKindManage', 'restKindC@restKindManageShow');

//Controller routes
Route::post('action_rmInt', 'menuC@restMenuInsert');
Route::post('action_rKInt', 'restKindC@restKindInsert');
Route::post('action_rKUp', 'restKindC@restKindUpdate');
Route::get('action_rKDel', 'restKindC@restKindDel');

Route::get('action_pcDel', 'orderC@purchaseDelete');


