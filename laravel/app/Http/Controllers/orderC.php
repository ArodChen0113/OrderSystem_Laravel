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
            ->select('rest_name')
            ->where('rest_open', 1)
            ->get();
        foreach ($rest_openName as $result) {
            $openN=$result->rest_name;
        }
        $rest_kind = DB::table('menu')
            ->select('kind')
            ->where('rest_name', $openN)
            ->get();

        return view('purchaseV', ['rest_kind' => $rest_kind]);
    }
    //訂購單頁面顯示2
    public function purchaseShow1()
    {
        $input = Input::all();
        $rest_openName = DB::table('restaurant')
            ->select('rest_name')
            ->where('rest_open', 1)
            ->get();
        foreach ($rest_openName as $result) {
            $openN=$result->rest_name;
        }
        $rest_kind = DB::table('menu')
            ->select('kind')
            ->where('rest_name', $openN)
            ->get();

        $result1 = DB::table('menu')
            ->select('kind','unit_price','menu_picture')
            ->where('kind', $input['select1'])
            ->get();
        foreach ($result1 as $i)
        {
            $kind=$i->kind;
            $price=$i->unit_price;
            $pic=$i->menu_picture;
        }
        return view('purchaseV1', ['rest_kind' => $rest_kind,'kind' => $kind,'price'=>$price,'pic'=>$pic,'openN'=>$openN]);
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
        $input = Input::all();
        if ($input['action'] != NULL && $input['action'] == 'insert')      //判斷值是否由欄位輸入
        {
            $last_price = DB::table('menu_order')//查詢之前訂購總額
            ->select('price')
                ->where('name', $input['orderName'])
                ->Where('pay', '!=', 9)
                ->get();
            foreach ($last_price as $i) {
                $lastPrice = $i->price;
            }
            DB::table('menu_order')->insert(array(
                array('name' => $input['orderName'], 'rest_name' => $input['restname'], 'kind' => $input['kind_p1'], 'price' => $input['sum'])//新增至資料庫
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
        $input = Input::all();
        if ($input['action'] != NULL && $input['action'] == 'pay'){
        DB::table('menu_order') //修改成已繳費
            ->where('name', $input['payname'])
            ->where('pay', '!=', 9)
            ->update(['pay' => 1]);

        header("Location:orderManageV");
        }
    }

}