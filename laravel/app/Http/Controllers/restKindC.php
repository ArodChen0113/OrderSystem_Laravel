<?php
namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Input;

class restKindC extends Controller
{

    public function __construct()
    {

    }
    //餐廳分類管理頁面顯示
    public function restKindManageShow()
    {
        $restData = DB::table('restaurant_kind')
            ->select('rest_kind','num')
            ->get();

        return view('restKindManageV', ['restData' => $restData]);
    }
    //餐廳分類下拉選單控制1
    public function restKindControl1()
    {
        $input = Input::all();
        $restKind = DB::table('restaurant_kind')
            ->select(DB::raw('rest_kind'))
            ->get();
        $restName = DB::table('restaurant')
            ->select('rest_name')
            ->where('rest_kind', $input['restKind'])
            ->get();
        $chooseKind=$input['restKind'];

        return view('restChooseV1', ['restKind' => $restKind,'chooseKind' =>$chooseKind,'restName' =>$restName]);
    }
    //餐廳分類下拉選單控制2
    public function restKindControl2()
    {
        $input = Input::all();
        $restKind = DB::table('restaurant_kind')
            ->select(DB::raw('rest_kind'))
            ->get();
        $restName = DB::table('restaurant')
            ->select('rest_name')
            ->where('rest_kind', $input['restKind'])
            ->get();
        $chooseKind=$input['restKind'];
        $chooseName=$input['restName'];

        return view('restChooseV2', ['restKind' => $restKind,'chooseKind' =>$chooseKind,'chooseName' =>$chooseName,'restName' =>$restName]);
    }
    //餐廳分類資料新增
    public function restKindInsert()
    {
        $input = Input::all();
        if ($input['action'] != NULL && $input['action'] == 'insert')      //判斷值是否由欄位輸入
        {
            DB::table('restaurant_kind')->insert(array(
                array('rest_kind' => $input['restKind'])
            ));
        }
        header("Location:restKindManageV");
    }
    //餐廳分類資料修改
    public function restKindUpdate()
    {
        $input = Input::all();
        if ($input['action'] != NULL && $input['action'] == 'update')      //判斷值是否由欄位輸入
        {
            $k=0;
            $count_kind=count($input['num']);
            for($i=1;$i<=$count_kind;$i++) {
                DB::table('restaurant_kind')
                    ->where('num', $input['num'][$k])
                    ->update(['rest_kind' => $input['restKind'][$k]]);
                $k++;
            }
        }
        header("Location:restKindManageV");
    }
    //餐廳分類資料刪除
    public function restKindDel()
    {
        $input = Input::all();
        if ($input['action'] != NULL && $input['action'] == 'delete')      //判斷值是否由欄位輸入
        {
            DB::table('restaurant_kind')->where('num', '=', $input['num'])->delete();
        }
        header("Location:restKindManageV");
    }
}