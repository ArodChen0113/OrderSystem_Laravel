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
        $rest_openName = DB::table('restaurant')
            ->select('rest_name','rest_picture')
            ->where('rest_open', 1)
            ->get();
        foreach ($rest_openName as $value) {
            $restName=$value->rest_name;
            $restPic=$value->rest_picture;
        }
        $restKind = DB::table('menu')
            ->select('kind')
            ->where('rest_name', $restName)
            ->get();

        return view('purchaseV', ['restKind' => $restKind,'restName' => $restName,'restPic' => $restPic]);
    }
    //訂購單頁面顯示2
    public function purchaseShow1()
    {
        $input = Input::all();
        $rest_openName = DB::table('restaurant')
            ->select('rest_name','rest_picture')
            ->where('rest_open', 1)
            ->get();
        foreach ($rest_openName as $value) {
            $restName=$value->rest_name;
            $restPic=$value->rest_picture;
        }
        $restKind = DB::table('menu')
            ->select('kind')
            ->where('rest_name', $restName)
            ->get();
        $menu_data = DB::table('menu')
            ->select('kind','unit_price','menu_picture')
            ->where('kind', $input['restKind'])
            ->get();
        foreach ($menu_data as $value2)
        {
            $kind=$value2->kind;
            $price=$value2->unit_price;
            $pic=$value2->menu_picture;
        }

        return view('purchaseV1', ['restKind' => $restKind,'kind' => $kind,'price'=>$price,'pic'=>$pic,'restName' => $restName,'restPic' => $restPic]);
    }

    //訂購單管理頁面顯示
    public function purchaseManageShow()
    {
        $orderData = DB::table('menu_order')
            ->select('name', 'price')
            ->where('pay', '!=', 9)
            ->groupBy('name')
            ->get();
        $rest_data=DB::table('restaurant')
            ->select('rest_name','rest_picture')
            ->where('rest_open', 1)
            ->get();
        foreach ($rest_data as $value)
        {
            $restName=$value->rest_name;
            $restPic=$value->rest_picture;
        }

        return view('purchaseManageV', ['orderData' => $orderData,'restName' => $restName,'restPic' => $restPic]);
    }

    //訂購單修改頁面顯示
    public function purchaseUpdateShow()
    {
        $input = Input::all();
        $order = DB::table('menu_order')
            ->join('menu', 'menu_order.kind', '=', 'menu.kind')
            ->where('name', $input['orderName'])
            ->Where('pay', '!=', 9)
            ->get();
        foreach ($order as $i){
            $sumPrice=$i->price;
        }
        $orderName=$input['orderName'];

        return view('purchaseUpdateV', ['order' => $order,'sumPrice' =>$sumPrice,'orderName'=>$orderName]);
    }
    //訂購單資料新增
    public function purchaseInsert()
    {
        $input = Input::all();
        if ($input['action'] != NULL && $input['action'] == 'insert')      //判斷值是否由欄位輸入
        {
            $last_price = DB::table('menu_order')//查詢之前訂購總額
            ->select('price')
                ->where('name', $input['orderName'])
                ->Where('pay', '!=', 9)
                ->get();
            foreach ($last_price as $value) {
                $lastPrice = $value->price;
            }
            date_default_timezone_set("Asia/Taipei"); //目前時間
            $date=date("Y-m-d h:i:s");
            DB::table('menu_order')->insert(array(
                array('name' => $input['orderName'], 'rest_Name' => $input['restName'], 'kind' => $input['kind_p1'], 'price' => $input['sum'],'date' => $date)//新增至資料庫
            ));
            $add=$lastPrice;
            $totalPrice = $add + $input['sum']; //加總新舊訂購總額
            DB::table('menu_order')
                ->where('name', $input['orderName'])
                ->Where('pay', '!=', 9)
                ->update(['price' => $totalPrice]);
            header("Location:purchaseManageV");
        }
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
            foreach ($order_price as $value) {
                $orderPrice=$value->price;
                $orderKind=$value->kind;
                $orderName=$value->name;
            }
            $last_price = DB::table('menu')
                ->select('unit_price')
                ->where('kind', $orderKind)
                ->get();
            foreach ($last_price as $value2) {
                $unitPrice=$value2->unit_price;
            }
            $updatePrice=$orderPrice-$unitPrice;

            DB::table('menu_order')            //修改訂購金額
                ->where('name', $orderName)
                ->update(['price' => $updatePrice]);

            DB::table('menu_order')->where('num', '=', $input['num'])->delete(); //刪除訂購項目
        }
        header("Location:purchaseUpdateV?orderName=$orderName");
    }
    //訂單管理頁面顯示
    public function orderManageShow()
    {
        $today = DB::table('restaurant') //今日開餐＆電話
            ->select('rest_name','rest_tel')
            ->where('rest_open', 1)
            ->get();
        foreach ($today as $value) {
            $open_restName=$value->rest_name;
            $open_restTel=$value->rest_tel;
        }

        $orderData = DB::table('menu_order') //訂購名單&單價&是否繳費
            ->select('price','name','pay')
            ->where('pay', '!=', 9)
            ->groupBy('name')
            ->get();

        $orderCount = DB::table('menu_order') //餐點數量
        ->select('name')
            ->where('pay', '!=', 9)
            ->get();
        $totalPrice=0;
     foreach ($orderData as $value2) //金額總計
     {
         $row_orderSum = $value2->price;
         $totalPrice = $totalPrice + $row_orderSum;
     }

        $order_menu = DB::table('menu_order') //菜單明細顯示
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

        return view('orderManageV', ['open_restName' => $open_restName,'open_restTel' =>$open_restTel,'orderData' =>$orderData,'orderCount' =>$orderCount,'totalPrice' =>$totalPrice,'order_menu' =>$order_menu,'order_pic' =>$order_pic,'order_unitPrice' =>$order_unitPrice,'kindCount' =>$kindCount,'kindOrderName' =>$kindOrderName]);
    }
    //訂餐付款控制
    public function orderPay()
    {
        $input = Input::all();
        if ($input['action'] != NULL && $input['action'] == 'pay'){
        DB::table('menu_order') //修改成已繳費
            ->where('name', $input['payName'])
            ->where('pay', '!=', 9)
            ->update(['pay' => 1]);

        header("Location:orderManageV");
        }
    }

}