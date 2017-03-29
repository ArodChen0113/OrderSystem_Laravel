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
        $rest_data = DB::table('restaurant_kind')
            ->select('rest_kind','num')
            ->get();

        return view('restKindManageV', ['rest_data' => $rest_data]);
    }
    //餐廳分類下拉選單控制1
    public function restKindControl1()
    {
        $input = Input::all();
        $rest_kind_echo = DB::table('restaurant_kind')
            ->select(DB::raw('rest_kind'))
            ->get();
        $restKind_name = DB::table('restaurant')
            ->select('rest_name')
            ->where('rest_kind', $input['select1'])
            ->get();
        $choosekind=$input['select1'];

        return view('restChooseV1', ['rest_kind_echo' => $rest_kind_echo,'choosekind' =>$choosekind,'restKind_name' =>$restKind_name]);
    }
    //餐廳分類下拉選單控制2
    public function restKindControl2()
    {
        $input = Input::all();
        $rest_kind_echo = DB::table('restaurant_kind')
            ->select(DB::raw('rest_kind'))
            ->get();
        $restKind_name = DB::table('restaurant')
            ->select('rest_name')
            ->where('rest_kind', $input['select1'])
            ->get();
        $choosekind=$input['select1'];
        $choosename=$input['select2'];

        return view('restChooseV2', ['rest_kind_echo' => $rest_kind_echo,'choosekind' =>$choosekind,'choosename' =>$choosename,'restKind_name' =>$restKind_name]);
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