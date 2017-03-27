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
        $rest_kind_echo = DB::table('restaurant_kind')
            ->select(DB::raw('rest_kind'))
            ->get();
        $rest_num_echo = DB::table('restaurant_kind')
            ->select(DB::raw('num'))
            ->get();
        return view('restKindManageV', ['rest_kind_echo' => $rest_kind_echo,'rest_num_echo' =>$rest_num_echo]);
    }
    //餐廳分類下拉選單控制1
    public function restKindControl1()
    {

    }
    //餐廳分類下拉選單控制2
    public function restKindControl2()
    {

    }
    //餐廳分類資料新增
    public function restKindInsert()
    {
        $input = Input::all();
        if ($input['action'] != NULL && $input['action'] == 'insert')      //判斷值是否由欄位輸入
        {
            DB::table('restaurant_kind')->insert(array(
                array('rest_kind' => $input['rest_kind_inster'])
            ));
        }
        header("Location:restKindManage");
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
                    ->update(['rest_kind' => $input['rest_kind'][$k]]);
                $k++;
            }
        }
        header("Location:restKindManage");
    }
    //餐廳分類資料刪除
    public function restKindDel()
    {
        $input = Input::all();
        if ($input['action'] != NULL && $input['action'] == 'delete')      //判斷值是否由欄位輸入
        {
            DB::table('restaurant_kind')->where('num', '=', $input['num2'])->delete();
        }
        header("Location:restKindManage");
    }
}