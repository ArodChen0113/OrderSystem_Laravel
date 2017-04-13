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


class orderC extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth');  //驗證使用者是否登入
        $this -> closeOpen();         //檢驗開餐時間
    }
    //訂購單頁面顯示
    public function purchaseShow()
    {
        $this -> noRestOpen();        //如無開餐,導入無開餐頁面
        $input = Input::all();
        $action = Input::get('action', '');
        $orderKind='';
        if($action== 'insert'){
            $orderKind=$this->purchaseInsert($action,$input['num']);
        }
        $echoCloseTime = $this->closeTimeString();    //關餐時間(拆解字串顯示)
        $timer=$this->closeTimer();                   //關餐計時器
        $restOpen = DB::table('restaurant')
            ->select('rest_name')
            ->where('rest_open', 1)
            ->get();
            $restName = $restOpen[0]->rest_name;
            $restMenuAll = DB::table('menu')
                ->select('kind', 'unit_price', 'menu_picture', 'm_num', 'm_star')
                ->where('rest_name', $restName)
                ->orderBy('m_star', 'desc')
                ->get();
            $restMenuRice = DB::table('menu')
                ->select('kind', 'unit_price', 'menu_picture', 'm_num', 'm_star')
                ->where('rest_name', $restName)
                ->where('m_kind', '飯')
                ->orderBy('m_star', 'desc')
                ->get();
            $restMenuNoodle = DB::table('menu')
                ->select('kind', 'unit_price', 'menu_picture', 'm_num', 'm_star')
                ->where('rest_name', $restName)
                ->where('m_kind', '麵')
                ->orderBy('m_star', 'desc')
                ->get();
            $restMenuSoup = DB::table('menu')
                ->select('kind', 'unit_price', 'menu_picture', 'm_num', 'm_star')
                ->where('rest_name', $restName)
                ->where('m_kind', '湯')
                ->orderBy('m_star', 'desc')
                ->get();
            $restMenuSideDishes = DB::table('menu')
                ->select('kind', 'unit_price', 'menu_picture', 'm_num', 'm_star')
                ->where('rest_name', $restName)
                ->where('m_kind', '小菜')
                ->orderBy('m_star', 'desc')
                ->get();
            return view('purchaseV', ['restOpen' => $restOpen,'restName' => $restName, 'restMenuAll' => $restMenuAll, 'restMenuRice' => $restMenuRice, 'restMenuNoodle' => $restMenuNoodle, 'restMenuSoup' => $restMenuSoup, 'restMenuSideDishes' => $restMenuSideDishes,'hours' => $echoCloseTime[0],'minutes' => $echoCloseTime[1],'timer' => $timer,'orderKind'=>$orderKind]);
        }
    //熱門訂餐頁面顯示
    public function purchaseHotOrderShow()
    {
        $this -> noRestOpen();        //如無開餐,導入無開餐頁面
        $input = Input::all();
        $action = Input::get('action', '');
        $orderKind='';
        if($action== 'insert'){
            $orderKind=$this->purchaseInsert($action,$input['num']);
        }
        $echoCloseTime = $this->closeTimeString();    //關餐時間(拆解字串顯示)
        $timer=$this->closeTimer();                   //關餐計時器
        $rest_openName = DB::table('restaurant')
            ->select('rest_name')
            ->where('rest_open', 1)
            ->get();
        $restName = $rest_openName[0]->rest_name;
        $restMenuAll = DB::table('menu')
            ->select('kind','unit_price','menu_picture','m_num','m_star','m_count')
            ->where('rest_name', $restName)
            ->orderBy('m_count', 'desc')
            ->get();
        return view('purchaseHotOrderV', ['restName' => $restName,'restMenuAll' => $restMenuAll,'hours' => $echoCloseTime[0],'minutes' => $echoCloseTime[1],'timer' => $timer,'orderKind'=>$orderKind]);
    }
    //最佳評價頁面顯示
    public function purchaseHotStarShow()
    {
        $this -> noRestOpen();        //如無開餐,導入無開餐頁面
        $input = Input::all();
        $action = Input::get('action', '');
        $orderKind='';
        if($action== 'insert'){
            $orderKind=$this->purchaseInsert($action,$input['num']);
        }
        $echoCloseTime = $this->closeTimeString();    //關餐時間(拆解字串顯示)
        $timer=$this->closeTimer();                   //關餐計時器
        $rest_openName = DB::table('restaurant')
            ->select('rest_name')
            ->where('rest_open', 1)
            ->get();
        $restName = $rest_openName[0]->rest_name;
        $restMenuAll = DB::table('menu')
            ->select('kind','unit_price','menu_picture','m_num','m_star')
            ->where('rest_name', $restName)
            ->orderBy('m_star', 'desc')
            ->get();
        return view('purchaseHotStarV', ['restName' => $restName,'restMenuAll' => $restMenuAll,'hours' => $echoCloseTime[0],'minutes' => $echoCloseTime[1],'timer' => $timer,'orderKind'=>$orderKind]);
    }

    //我的訂餐頁面顯示
    public function purchaseManageShow()
    {
        $this -> noRestOpen();        //如無開餐,導入無開餐頁面
        $input = Input::all();
        $action = Input::get('action', '');
        $orderKind='';
        if($action== 'insert'){
            $orderKind=$this->purchaseInsert(); //熱門訂餐新增
        }

        if($action== 'delete'){
            $orderKind=$this->purchaseDelete(); //單筆訂餐刪除
        }
        $echoCloseTime = $this->closeTimeString();    //關餐時間(拆解字串顯示)
        $timer=$this->closeTimer();                   //關餐計時器
        $user = Auth::user();
        $orderName = $user->name;
        $orderData = DB::table('menu_order')
            ->join('menu', 'menu_order.kind', '=', 'menu.kind')
            ->where('name', $orderName)
            ->Where('pay', '!=', 9)
            ->get();
        if($orderData!=NULL) {
            $sumPrice = $orderData[0]->price;
        }else
        {
            $sumPrice = 0;
        }
        $todayOpen = DB::table('restaurant')
            ->select('rest_name')
            ->where('rest_open', 1)
            ->get();
        $openRestName=$todayOpen[0]->rest_name;

        $hotOrder = DB::table('menu')
            ->select('kind','unit_price','menu_picture','m_num','m_star')
            ->where('rest_name', $openRestName)
            ->orderBy('m_count', 'desc')
            ->get();
        $error = new evaluationC();
        $error -> doEvaluation();                   //是否已評價(一次/天)
        return view('purchaseManageV', ['orderData' => $orderData,'sumPrice' =>$sumPrice,'hotOrder'=>$hotOrder,'error'=>$error,'hours' => $echoCloseTime[0],'minutes' => $echoCloseTime[1],'timer' => $timer,'orderKind'=>$orderKind,'action'=>$action]);
    }
    //訂購單資料新增
    public function purchaseInsert()
    {
        $input = Input::all();
        if ($input['action'] != NULL && $input['action'] == 'insert')      //判斷值是否由欄位輸入
        {
            $user = Auth::user();
            $orderName = $user->name;
            $last_price = DB::table('menu_order') //查詢之前訂購總額
            ->select('price')
                ->where('name', $orderName)
                ->Where('pay', '!=', 9)
                ->get();
            if($last_price!=NULL) {
                $lastPrice = $last_price[0]->price;
            }else{
                $lastPrice = 0;
            }
            $orderDate = DB::table('menu')        //查詢訂購項目資料
            ->select('unit_price','kind','rest_name')
                ->where('m_num', $input['num'])
                ->get();
            $orderRestName = $orderDate[0]->rest_name;
            $orderKind = $orderDate[0]->kind;
            $orderPrice = $orderDate[0]->unit_price;

            $checkOrder = DB::table('menu_order')        //查詢是否有同商品訂購紀錄
            ->select('kind','qty')
                ->where('name', $orderName)
                ->where('kind', $orderKind)
                ->Where('pay', '!=', 9)
                ->get();

            if($checkOrder==NULL) {
                date_default_timezone_set("Asia/Taipei"); //目前時間
                $date = date("Y-m-d H:i:s");
                DB::table('menu_order')->insert(array(
                    array('name' => $orderName, 'rest_Name' => $orderRestName, 'kind' => $orderKind, 'price' => $orderPrice, 'date' => $date)//新增至資料庫
                ));
            }else
            {
                $qty=$checkOrder[0]->qty;
                $checkKind=$checkOrder[0]->kind;
                $upQty=$qty+1;
                DB::table('menu_order')
                    ->where('name', $orderName)
                    ->where('kind', $orderKind)
                    ->Where('pay', '!=', 9)
                    ->update(['qty' => $upQty]);
            }
            $add=$lastPrice;
            $totalPrice = $add + $orderPrice; //加總新舊訂購總額
            DB::table('menu_order')
                ->where('name', $orderName)
                ->Where('pay', '!=', 9)
                ->update(['price' => $totalPrice]);

            $m_Count = DB::table('menu')     //查詢之前訂購數量
            ->select('m_count')
                ->where('kind', $orderKind)
                ->get();
            $mCount = $m_Count[0]->m_count;
            $mCount = $mCount+1;
            DB::table('menu')          //更新該菜色訂購數量
                ->where('kind', $orderKind)
                ->update(['m_count' => $mCount]);
            return $orderKind ;
        }else{
            return false ;
        }
    }
    //訂購單資料單筆刪除
    public function purchaseDelete()
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
            return $orderKind ;
        }else{
            return false;
        }
    }
    //訂單管理頁面顯示(以訂購者排序)
    public function orderNameManageShow()
    {
        $this->Authority(); //權限驗證
        $echoCloseTime = $this->closeTimeString();    //關餐時間(拆解字串顯示)
        $timer=$this->closeTimer();                   //關餐計時器
        $input = Input::all();
        $action = Input::get('action', '');
        if($action== 'pay'){
            $this->orderPay(); //訂餐付款修改控制
        }

        $todayOpen = DB::table('restaurant') //今日開餐＆電話
            ->select('rest_name','rest_tel')
            ->where('rest_open', 1)
            ->orWhere('rest_open', 2)
            ->get();
            $open_restName=$todayOpen[0]->rest_name;
            $open_restTel=$todayOpen[0]->rest_tel;

        $orderData = DB::table('menu_order') //訂購名單&單價&是否繳費
            ->select('price','name','pay')
            ->where('pay', '!=', 9)
            ->groupBy('name')
            ->get();

        $orderCount = DB::table('menu_order') //餐點數量
        ->select('qty')
            ->where('pay', '!=', 9)
            ->get();
        $sumOrderCount=0;
        for($i=0;$i<=count($orderCount)-1;$i++){
            $qty=$orderCount[$i]->qty;
            $sumOrderCount=$sumOrderCount+$qty;
        }
        $totalPrice=0;
     foreach ($orderData as $value) //金額總計
     {
         $row_orderSum = $value->price;
         $totalPrice = $totalPrice + $row_orderSum;
     }
        return view('orderNameManageV', ['open_restName' => $open_restName,'open_restTel' =>$open_restTel,'orderData' =>$orderData,'sumOrderCount' =>$sumOrderCount,'totalPrice' =>$totalPrice,'hours' => $echoCloseTime[0],'minutes' => $echoCloseTime[1],'timer' => $timer]);
    }
    //訂單管理頁面顯示(以菜單名排序)
    public function orderMenuManageShow()
    {
        $this->Authority(); //權限驗證
        $echoCloseTime = $this->closeTimeString();    //關餐時間(拆解字串顯示)
        $timer=$this->closeTimer();                   //關餐計時器
        $order_menu = DB::table('menu_order') //菜單明細顯示
        ->select('kind')
            ->where('pay', '!=', 9)
            ->groupBy('kind')
            ->get();
        if($order_menu!=NULL){
        $num=count($order_menu);
        for($i=0;$i<=$num-1;$i++){
            $v=$order_menu[$i];
            $save_data = DB::table('menu')  //菜單圖片&單價
            ->select('menu_picture','unit_price')
                ->where('kind', $v->kind)
                ->get();
                $order_pic[$i]=$save_data[0]->menu_picture;
                $order_unitPrice[$i]=$save_data[0]->unit_price;
        }
        $num=count($order_menu);
        for($i=0;$i<=$num-1;$i++) {
            $v=$order_menu[$i];
            $save_data = DB::table('menu_order')  //點餐數量
            ->select('qty')
                ->where('kind', $v->kind)
                ->where('pay', '!=', 9)
                ->get();
            $num2=count($save_data);
            $sumQty=0;
            for($a=0;$a<=$num2-1;$a++) {
                $sumQty=$sumQty+$save_data[$a]->qty;
            }
                $kindCount[$i]=$sumQty;
            }

        $num=count($order_menu);
        for($i=0;$i<=$num-1;$i++) {
            $v=$order_menu[$i];
            $save_data = DB::table('menu_order')  //點餐名單
            ->select('name','qty')
                ->where('kind', $v->kind)
                ->where('pay', '!=', 9)
                ->get();
            $num2=count($save_data);
            for($a=0;$a<=$num2-1;$a++) {
                $kindOrderName[$i] = $save_data;
            }
        }
        return view('orderMenuManageV', ['order_menu' =>$order_menu,'order_pic' =>$order_pic,'order_unitPrice' =>$order_unitPrice,'kindCount' =>$kindCount,'kindOrderName' =>$kindOrderName,'hours' => $echoCloseTime[0],'minutes' => $echoCloseTime[1],'timer' => $timer]);
    }else{
            return view('orderMenuManageV',['order_menu' =>$order_menu,'hours' => $echoCloseTime[0],'minutes' => $echoCloseTime[1]]);
        }
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
        return true;
        }else{
            return false;
        }
    }
    //關餐時間
    public function closeTime()
    {
        $rowCloseTime = DB::table('restaurant')  //關餐時間
        ->select('close_time')
            ->where('rest_open', 1)
            ->get();
        if($rowCloseTime!=NULL){
            $closeTime = $rowCloseTime[0]->close_time;
        }else{
            $closeTime = '';
        }
        return $closeTime;
    }
    //關餐時間(拆解顯示字串)
    public function closeTimeString()
    {
        $closeTime = $this->closeTime();                              //關餐時間
        if($closeTime!=NULL) {
            $closeTimeString = preg_split('/ /', $closeTime);         //拆解字串
            $echoCloseTime = preg_split('/:/', $closeTimeString[1]);  //拆解字串
        }else
        {
            $echoCloseTime = '';
        }
            return $echoCloseTime;
    }
    //關閉訂餐(已到關餐時間)
    public function closeOpen()
    {
        $closeTime = $this->closeTime();          //關餐時間
        date_default_timezone_set("Asia/Taipei"); //目前時間
        $checkTime = date("Y-m-d H:i:s");

        if(strtotime($checkTime)>strtotime($closeTime)) {
            DB::table('restaurant')               //關閉開餐
            ->where('rest_open', 1)
                ->update(['rest_open' => 2]);
        }
    }
    //尚未開餐頁面判斷
    public function noRestOpen()
    {
        $restOpen = DB::table('restaurant')
            ->select('rest_name')
            ->where('rest_open', 1)
            ->get();
        if($restOpen==NULL) {
            header("Location:noRestOpenV");
            exit;
        }
    }
    //關餐倒數計時器
    public function closeTimer()
    {
        date_default_timezone_set("Asia/Taipei"); //設定時區
        $nowTime = date("Y-m-d H:i:s");           //目前時間
        $closeTime = $this->closeTime();          //關餐時間
        $time = strtotime($closeTime) - strtotime($nowTime);
        $timer = str_pad(floor($time % (24 * 3600) / 3600), 2, 0, STR_PAD_LEFT) . "Hours " . str_pad(floor($time % 3600 / 60), 2, 0, STR_PAD_LEFT) . "Minutes left"; //時間換算
        return $timer;
    }

}