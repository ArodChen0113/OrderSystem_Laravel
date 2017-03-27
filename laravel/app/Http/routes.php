<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('restMenuInsert', 'menuC@restMenuInsertShow');

Route::get('mypage', function () {

    $data = array('var1' => '京城五','var2' => '王力宏','var3' => '周杰魂' );

    return view('mypage',$data);
});

Route::get('con', 'testC@index');

Route::get('/test', function()
{
    // 測試一：取得users資料表的全部資料
//    $users = DB::table('restaurant')->get();
//    return $users;

    // 測試二：取得users資料表，id為1的資料
//    $user = DB::table('restaurant')->find(1);
////    dd($user);  // dd means: die(var_dump($user));
//    return $user->username;

//     測試三：用where條件式來取得相關資料
//    $users = DB::table('restaurant')->where("rest_name", "!=", "快樂餐館")->get();
    $users = DB::select('select * from restaurant');
    return $users;
});

