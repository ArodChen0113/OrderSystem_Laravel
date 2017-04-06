<?php
namespace App\Http\Controllers;

use DB;
use Input;
use Gate;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;

class orderC extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); //驗證使用者是否登入

    }
    //訂購單頁面顯示
    public function purchaseShow()
    {
        $rest_openName = DB::table('restaurant')
            ->select('rest_name')
            ->where('rest_open', 1)
            ->get();
        $restName = $rest_openName[0]->rest_name;
        $restMenuAll = DB::table('menu')
            ->select('kind','unit_price','menu_picture','m_num')
            ->where('rest_name', $restName)
            ->get();
        $restMenuRice = DB::table('menu')
            ->select('kind','unit_price','menu_picture','m_num')
            ->where('rest_name', $restName)
            ->where('m_kind', '飯')
            ->get();
        $restMenuNoodle = DB::table('menu')
            ->select('kind','unit_price','menu_picture','m_num')
            ->where('rest_name', $restName)
            ->where('m_kind', '麵')
            ->get();
        $restMenuSoup = DB::table('menu')
            ->select('kind','unit_price','menu_picture','m_num')
            ->where('rest_name', $restName)
            ->where('m_kind', '湯')
            ->get();
        $restMenuSideDishes = DB::table('menu')
            ->select('kind','unit_price','menu_picture','m_num')
            ->where('rest_name', $restName)
            ->where('m_kind', '小菜')
            ->get();
        return view('purchaseV', ['restName' => $restName,'restMenuAll' => $restMenuAll,'restMenuRice' => $restMenuRice,'restMenuNoodle' => $restMenuNoodle,'restMenuSoup' => $restMenuSoup,'restMenuSideDishes' => $restMenuSideDishes]);
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
            $restName=$rest_data[0]->rest_name;
            $restPic=$rest_data[0]->rest_picture;

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
            $sumPrice=$order[0]->price;
        $orderName=$input['orderName'];

        return view('purchaseUpdateV', ['order' => $order,'sumPrice' =>$sumPrice,'orderName'=>$orderName]);
    }
    //訂購單資料新增
    public function purchaseInsert()
    {
        $input = Input::all();
        if ($input['action'] != NULL && $input['action'] == 'insert')      //判斷值是否由欄位輸入
        {
            $orderName='Arod'; //暫存訂購者名稱(之後做會員系統時更換)
            $last_price = DB::table('menu_order') //查詢之前訂購總額
            ->select('price')
                ->where('name', $orderName)
                ->Where('pay', '!=', 9)
                ->get();
                $lastPrice = $last_price[0]->price;
            $orderDate = DB::table('menu')        //查詢訂購項目資料
            ->select('unit_price','kind','rest_name')
                ->where('m_num', $input['num'])
                ->get();
            $orderRestName = $orderDate[0]->rest_name;
            $orderKind = $orderDate[0]->kind;
            $orderPrice = $orderDate[0]->unit_price;
            date_default_timezone_set("Asia/Taipei"); //目前時間
            $date=date("Y-m-d h:i:s");
            DB::table('menu_order')->insert(array(
                array('name' => $orderName, 'rest_Name' => $orderRestName, 'kind' => $orderKind, 'price' => $orderPrice,'date' => $date)//新增至資料庫
            ));
            $add=$lastPrice;
            $totalPrice = $add + $orderPrice; //加總新舊訂購總額
            DB::table('menu_order')
                ->where('name', $orderName)
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
                $orderPrice=$order_price[0]->price;
                $orderKind=$order_price[0]->kind;
                $orderName=$order_price[0]->name;

            $last_price = DB::table('menu')
                ->select('unit_price')
                ->where('kind', $orderKind)
                ->get();
                $unitPrice=$last_price[0]->unit_price;

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
        $todayOpen = DB::table('restaurant') //今日開餐＆電話
            ->select('rest_name','rest_tel')
            ->where('rest_open', 1)
            ->get();
            $open_restName=$todayOpen[0]->rest_name;
            $open_restTel=$todayOpen[0]->rest_tel;

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
     foreach ($orderData as $value) //金額總計
     {
         $row_orderSum = $value->price;
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
         foreach ($save_data as $value){
             $order_pic[$i]=$value->menu_picture;
             $order_unitPrice[$i]=$value->unit_price;
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
            foreach ($save_data as $value){
                $kindCount[$i]=$value->kind_count;
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