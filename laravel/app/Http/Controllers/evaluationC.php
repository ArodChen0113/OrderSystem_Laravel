<?php
namespace App\Http\Controllers;

use DB;
use Input;
use Gate;
use App\Providers\AuthServiceProvider;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class evaluationC extends Controller
{

    public function __construct()
    {
        $this -> middleware('auth'); //驗證使用者是否登入
    }
    //顧客評比頁面顯示
    public function userEvaluationShow()
    {
        $input = Input::all();
        $action = Input::get('action', '');
        if($action== 'insert'){
            $this->purchaseInsert($action,$input['num']);
        }
        $user = Auth::user();
        $orderName = $user->name;
        $orderData = DB::table('menu_order') //今日訂購餐點
            ->join('menu', 'menu_order.kind', '=', 'menu.kind')
            ->where('name', $orderName)
            ->Where('pay', '!=', 9)
            ->get();
        $todayOpen = DB::table('restaurant')
            ->select('rest_name','rest_picture')
            ->where('rest_open', 1)
            ->get();

        return view('userEvaluationV', ['orderData' => $orderData,'todayOpen'=>$todayOpen]);
    }
    //人氣餐廳頁面顯示
    public function hotRestEvaluationShow()
    {
        $this->Authority(); //權限驗證
        $hotRestData = DB::table('restaurant')
            ->select('rest_name','rest_picture','r_star')
            ->orderBy('r_star', 'desc')
            ->get();

        return view('hotRestEvaluationV', ['hotRestData' => $hotRestData]);
    }
    //評價資料新增
    public function evaluationInsert()
    {
        $input = Input::all();

var_dump($input);
//        if ($input['action'] != NULL && $input['action'] == 'insert')      //判斷值是否由欄位輸入
//        {
//            $user = Auth::user();
//            $orderName = $user->name;
//            $last_price = DB::table('menu_order') //查詢之前訂購總額
//            ->select('price')
//                ->where('name', $orderName)
//                ->Where('pay', '!=', 9)
//                ->get();
//            if($last_price!=NULL) {
//                $lastPrice = $last_price[0]->price;
//            }else{
//                $lastPrice = 0;
//            }
//            $orderDate = DB::table('menu')        //查詢訂購項目資料
//            ->select('unit_price','kind','rest_name')
//                ->where('m_num', $input['num'])
//                ->get();
//            $orderRestName = $orderDate[0]->rest_name;
//            $orderKind = $orderDate[0]->kind;
//            $orderPrice = $orderDate[0]->unit_price;
//
//            $checkOrder = DB::table('menu_order')        //查詢是否有同商品訂購紀錄
//            ->select('kind','qty')
//                ->where('name', $orderName)
//                ->where('kind', $orderKind)
//                ->Where('pay', '!=', 9)
//                ->get();
//
//            if($checkOrder==NULL) {
//                date_default_timezone_set("Asia/Taipei"); //目前時間
//                $date = date("Y-m-d h:i:s");
//                DB::table('menu_order')->insert(array(
//                    array('name' => $orderName, 'rest_Name' => $orderRestName, 'kind' => $orderKind, 'price' => $orderPrice, 'date' => $date)//新增至資料庫
//                ));
//            }else
//            {
//                $qty=$checkOrder[0]->qty;
//                $checkKind=$checkOrder[0]->kind;
//                $upQty=$qty+1;
//                DB::table('menu_order')
//                    ->where('name', $orderName)
//                    ->where('kind', $orderKind)
//                    ->Where('pay', '!=', 9)
//                    ->update(['qty' => $upQty]);
//            }
//            $add=$lastPrice;
//            $totalPrice = $add + $orderPrice; //加總新舊訂購總額
//            DB::table('menu_order')
//                ->where('name', $orderName)
//                ->Where('pay', '!=', 9)
//                ->update(['price' => $totalPrice]);
//
//            $m_Count = DB::table('menu')     //查詢之前訂購數量
//            ->select('m_count')
//                ->where('kind', $orderKind)
//                ->get();
//            $mCount = $m_Count[0]->m_count;
//            $mCount = $mCount+1;
//            DB::table('menu')          //更新該菜色訂購數量
//                ->where('kind', $orderKind)
//                ->update(['m_count' => $mCount]);
//            return true;
//        }
    }
    //評價資料單筆刪除
    public function evaluationDelete()
    {
        $input = Input::all();
        if ($input['action'] != NULL && $input['action'] == 'delete')      //判斷值是否由欄位輸入
        {
            $order_price = DB::table('menu_order')
                ->select('price','kind','name','qty')
                ->where('num', $input['num'])
                ->get();
                $orderPrice=$order_price[0]->price;
                $orderKind=$order_price[0]->kind;
                $orderName=$order_price[0]->name;
                $orderQty=$order_price[0]->qty;

            $last_price = DB::table('menu')
                ->select('unit_price')
                ->where('kind', $orderKind)
                ->get();
                $unitPrice=$last_price[0]->unit_price;

            $updatePrice=$orderPrice-$unitPrice*$orderQty;

            DB::table('menu_order')            //修改訂購金額
                ->where('name', $orderName)
                ->update(['price' => $updatePrice]);

            $m_Count = DB::table('menu')     //查詢之前訂購數量
            ->select('m_count')
                ->where('kind', $orderKind)
                ->get();
            $mCount = $m_Count[0]->m_count;
            $mCount = $mCount-1;
            DB::table('menu')          //更新該菜色訂購數量
            ->where('kind', $orderKind)
                ->update(['m_count' => $mCount]);

            DB::table('menu_order')->where('num', '=', $input['num'])->delete(); //刪除訂購項目
        }
        header("Location:purchaseManageV?orderName=$orderName");
    }
}