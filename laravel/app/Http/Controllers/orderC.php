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

    }
    //訂餐付款控制
    public function orderPay()
    {

    }

}