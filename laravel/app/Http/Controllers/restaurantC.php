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
        $input = Input::all();
        $rest_data=DB::table('restaurant')
            ->where('rest_name', $input['select_restName'])
            ->get();
        foreach ($rest_data as $i)
        {
            $restname=$i->rest_name;
            $restkind=$i->rest_kind;
            $resttel=$i->rest_tel;
            $restpic=$i->rest_picture;
            $restnum=$i->num;
        }

        return view('restManageV', ['restname' => $restname,'restkind' => $restkind,'resttel' => $resttel,'restpic' => $restpic,'restnum' => $restnum]);
    }
    //餐廳資料修改
    public function restUpdate()
    {
        $input = Input::all();
//        $restpic_name = Input::file('rest_picture')->getClientOriginalName();
        if ($input['action'] != NULL && $input['action'] == 'update')      //判斷值是否由欄位輸入
        {
            DB::table('restaurant')
                ->where('num', $input['num'])
                ->update(['rest_name' => $input['rest_name']]);
            DB::table('restaurant')
                ->where('num', $input['num'])
                ->update(['rest_kind' => $input['rest_kind']]);
            DB::table('restaurant')
                ->where('num', $input['num'])
                ->update(['rest_tel' => $input['rest_tel']]);
//            DB::table('restaurant')
//                ->where('num', $input['num'])
//                ->update(['rest_picture' => $restpic_name]);
        }
        header("Location:restChooseV");
    }
    //餐廳資料刪除
    public function restDel()
    {
        $input = Input::all();
        if ($input['action'] != NULL && $input['action'] == 'delete')      //判斷值是否由欄位輸入
        {
            DB::table('menu_order')->where('rest_name', '=', $input['restname'])->delete();
            DB::table('menu')->where('rest_name', '=', $input['restname'])->delete();
            DB::table('restaurant')->where('rest_name', '=', $input['restname'])->delete();
        }
        header("Location:restChooseV");
    }
}