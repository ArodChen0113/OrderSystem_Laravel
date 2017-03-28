<?php
namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Input;

class restaurantC extends Controller
{
    public function __construct()
    {

    }
    //餐廳選擇器顯示
    public function restChooseShow()
    {
        $rest_kind_echo = DB::table('restaurant_kind')
            ->select(DB::raw('rest_kind'))
            ->get();
        $todayopen=DB::table('restaurant')
            ->select('rest_name')
            ->where('rest_open', '==', 1)
            ->get();

        return view('restChooseV', ['rest_kind_echo' => $rest_kind_echo,'todayopen' =>$todayopen]);
    }
    //餐廳管理頁面顯示
    public function restManageShow()
    {
        return view('restManageV', ['rest_kind_echo' => $rest_kind_echo,'rest_num_echo' =>$rest_num_echo]);
    }
    //餐廳資料修改
    public function restUpdate()
    {

    }
    //餐廳資料刪除
    public function restDel()
    {

    }
    //今日開餐執行控制
    public function restOpen()
    {

    }
    //今日開餐資料顯示
    public function restOpenShow()
    {

    }
}