<?php
namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Input;

class restKindC extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); //驗證使用者是否登入
    }
    //餐廳分類管理頁面顯示
    public function restKindManageShow()
    {
        $input = Input::all();
        $this->Authority(); //權限驗證
        $action = Input::get('action', '');
        if($action == 'insert'){
            $this->restKindInsert(); //餐廳分類新增
        }
        if($action == 'update'){
            $this->restKindUpdate(); //餐廳分類修改
        }
        if($action == 'delete'){
            $this->restKindDel(); //餐廳分類刪除
        }
        $restData = DB::table('restaurant_kind')
            ->select('rest_kind','num')
            ->get();

        return view('restKindManageV', ['restData' => $restData, 'action' => $action]);
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
            return true;
        }else{
            return false;
        }
    }
    //餐廳分類資料修改
    public function restKindUpdate()
    {
        $input = Input::all();
        if ($input['action'] != NULL && $input['action'] == 'update')      //判斷值是否由欄位輸入
        {
            $k=0;
            for($i=1 ; $i<count($input['num']) ; $i++) {
                DB::table('restaurant_kind')
                    ->where('num', $input['num'][$k])
                    ->update(['rest_kind' => $input['restKind'][$k]]);
                $k++;
            }
            return true;
        }else{
            return false;
        }
    }
    //餐廳分類資料刪除
    public function restKindDel()
    {
        $input = Input::all();
        if ($input['action'] != NULL && $input['action'] == 'delete')      //判斷值是否由欄位輸入
        {
            DB::table('restaurant_kind')->where('num', '=', $input['num'])->delete();
            return true;
        }else{
            return false;
        }
    }
}