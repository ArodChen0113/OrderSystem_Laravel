<?php
namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Input;

class orderC extends Controller
{

    public function __construct()
    {

    }
    //訂購單頁面顯示
    public function purchaseShow()
    {

    }
    //訂購單細節控制顯示
    public function purchaseDetailShow()
    {

    }
    //訂購單管理頁面顯示
    public function purchaseManageShow()
    {
        $order_name = DB::table('menu_order')
            ->select('name', 'price')
            ->where('pay', '!=', 9)
            ->groupBy('name')
            ->get();
        $order_price = DB::table('menu_order')
            ->select('price')
            ->where('pay', '!=', 9)
            ->groupBy('name')
            ->get();
        return view('purchaseManageV', ['order_name' => $order_name,'order_price' =>$order_price]);
    }
    //訂購單修改頁面顯示
    public function purchaseUpdateShow()
    {
        $input = Input::all();
        $order = DB::table('menu_order')
            ->join('menu', 'menu_order.kind', '=', 'menu.kind')
            ->where('name', $input['postname'])
            ->Where('pay', '!=', 9)
            ->get();

        $order_price = DB::table('menu_order')
            ->select('price')
            ->where('name', $input['postname'])
            ->Where('pay', '!=', 9)
            ->get();
        $orderName=$input['postname'];

        return view('purchaseUpdateV', ['order' => $order,'order_price' =>$order_price,'orderName'=>$orderName]);
    }
    //訂購單資料新增
    public function purchaseInsert()
    {

    }
    //訂購單資料刪除
    public function purchaseDelete()
    {
        $input = Input::all();
        if ($input['action'] != NULL && $input['action'] == 'delete')      //判斷值是否由欄位輸入
        {
            $order_price = DB::table('menu_order')
                ->select('price','kind','name')
                ->where('num', $input['num'])
                ->get();
            foreach ($order_price as $result) {
                $OrderP=$result->price;
                $OrderK=$result->kind;
                $OrderN=$result->name;
            }
            $last_price = DB::table('menu')
                ->select('unit_price')
                ->where('kind', $OrderK)
                ->get();
            foreach ($last_price as $result2) {
                $unitprice=$result2->unit_price;
            }
            $updateprice=$OrderP-$unitprice;

            DB::table('menu_order')
                ->where('name', $OrderN)
                ->update(['price' => $updateprice]);

            DB::table('menu_order')->where('num', '=', $input['num'])->delete();
        }
        header("Location:purchaseUpdateV?postname=$OrderN");
    }
    //訂單管理頁面顯示
    public function orderManageShow()
    {
        $today = DB::table('restaurant') //今日開餐＆電話
            ->select('rest_name','rest_tel')
            ->where('rest_open', 1)
            ->get();
        foreach ($today as $result) {
            $open_restName=$result->rest_name;
            $open_restTel=$result->rest_tel;
        }

        $order_data = DB::table('menu_order') //訂購名單&單價&是否繳費
            ->select('price','name','pay')
            ->where('pay', '!=', 9)
            ->groupBy('name')
            ->get();

        $order_people = DB::table('menu_order') //訂餐人數
        ->select('name')
            ->where('pay', '!=', 9)
            ->distinct()
            ->get();

        $orderCount = DB::table('menu_order') //餐點數量
        ->select('name')
            ->where('pay', '!=', 9)
            ->get();
        $totalPrice=0;
     foreach ($order_data as $result2) //金額總計
     {
         $row_ordersum = $result2->price;
         $totalPrice = $totalPrice + $row_ordersum;
     }

        $order_menu = DB::table('menu_order') //餐點數量
        ->select('kind')
            ->where('pay', '!=', 9)
            ->groupBy('kind')
            ->get();

     $num=count($order_menu);
     for($i=0;$i<=$num-1;$i++) {
         $v=$order_menu[$i];
         $save_data = DB::table('menu')  //菜單圖片&單價
         ->select('menu_picture','unit_price')
             ->where('kind', $v->kind)
             ->get();
         foreach ($save_data as $j){
             $order_pic[$i]=$j->menu_picture;
             $order_unitPrice[$i]=$j->unit_price;
         }
     }

        $num=count($order_menu);
        for($i=0;$i<=$num-1;$i++) {
            $v=$order_menu[$i];
            $save_data = DB::table('menu_order')  //點餐數量
            ->select(DB::raw('count(kind) as kind_count'))
                ->where('kind', $v->kind)
                ->where('pay', '!=', 9)
                ->get();
            foreach ($save_data as $j){
                $kindCount[$i]=$j->kind_count;
            }
        }

        $num=count($order_menu);
        for($i=0;$i<=$num-1;$i++) {
            $v=$order_menu[$i];
            $save_data = DB::table('menu_order')  //點餐名單
            ->select('name')
                ->where('kind', $v->kind)
                ->where('pay', '!=', 9)
                ->get();
            $num2=count($save_data);
            for($a=0;$a<=$num2-1;$a++) {
                    $kindOrderName[$i] = $save_data;
            }
        }

        return view('orderManageV', ['open_restName' => $open_restName,'open_restTel' =>$open_restTel,'order_data' =>$order_data,'order_people' =>$order_people,'orderCount' =>$orderCount,'totalPrice' =>$totalPrice,'order_menu' =>$order_menu,'order_pic' =>$order_pic,'order_unitPrice' =>$order_unitPrice,'kindCount' =>$kindCount,'kindOrderName' =>$kindOrderName]);
    }
    //訂餐付款控制
    public function orderPay()
    {

    }

}