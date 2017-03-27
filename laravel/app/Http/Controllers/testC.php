<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;

class testC extends Controller
{
    /**
     * 顯示應用程式的所有使用者列表。
     *
     * @return Response
     */
    public function index()
    {
        $user = DB::table('restaurant')->where('rest_name', '快樂餐館')->first();

        $result[0] = $user->rest_tel;
        $result[1] = $user->rest_name;

        var_dump($result[0]);
        echo $result[0];
        echo $result[1];
//        return view('mypage', $result);
    }
}