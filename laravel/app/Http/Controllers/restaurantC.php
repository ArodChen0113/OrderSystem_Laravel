<?php
namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Input;
use Illuminate\Http\Request;
use App\Http\Controllers\orderC;

class restaurantC extends Controller
{
    var $check;
    public function __construct()
    {
        $this->middleware('auth'); //驗證使用者是否登入
    }
    //餐廳選擇器顯示
    public function restChooseShow()
    {
        $this->Authority(); //權限驗證
        $input = Input::all();
        $action = Input::get('action', '');
        $control = input::get('control','0');
        $restKind = DB::table('restaurant_kind')
            ->select(DB::raw('rest_kind'))
            ->get();
        if($control == 0){
            $chooseKind = '';
            $chooseName = '';
            $restName = Input::get('restName', '');
        return view('restChooseV', ['restKind' => $restKind, 'chooseKind' => $chooseKind, 'chooseName' => $chooseName,
            'restName' => $restName, 'control'=> $control , 'action' => $action]);
        }

        if($control == 1) {
            $restName = DB::table('restaurant')
                ->select('rest_name')
                ->where('rest_kind', $input['restKind'])
                ->get();
            $chooseKind = $input['restKind'];
            $chooseName = '';
            return view('restChooseV', ['restKind' => $restKind, 'chooseKind' => $chooseKind,
                'chooseName' => $chooseName, 'restName' => $restName, 'control' => $control, 'action' => $action]);
        }

        if($control == 2) {
            $restName = DB::table('restaurant')
                ->select('rest_name')
                ->where('rest_kind', $input['restKind'])
                ->get();
            $chooseKind = $input['restKind'];
            $chooseName = $input['restName'];

            return view('restChooseV', ['restKind' => $restKind, 'chooseKind' => $chooseKind,
                'chooseName' => $chooseName, 'restName' => $restName, 'control' => $control, 'action' => $action]);
        }
    }
    //餐廳管理頁面顯示
    public function restManageShow()
    {
        $this->Authority(); //權限驗證
        $action = Input::get('action', '');
        if($action == 'update'){
            $restName = $this->restUpdate(); //餐廳資料修改
            header("Location:restChooseV?action=$action&restName=$restName");
            exit;
        }
        if($action == 'delete'){
            $restName = $this->restDel();    //餐廳資料刪除
            header("Location:restChooseV?action=$action&restName=$restName");
            exit;
        }

        $rest_data=DB::table('restaurant')
            ->where('rest_name', Input::get('restName',''))
            ->get();

        return view('restManageV', ['restName' => $rest_data[0]->rest_name, 'restKind' => $rest_data[0]->rest_kind,
            'restTel' => $rest_data[0]->rest_tel, 'restPic' => $rest_data[0]->rest_picture,
            'restNum' => $rest_data[0]->num]);
    }
    //今日開餐頁面顯示
    public function openMealShow()
    {
        $this->Authority(); //權限驗證
        $action = Input::get('action', '');
        if($action == 'open'){
            $this->openMealUp(); //開餐
            header("Location:/");
            exit;
        }

        $input = Input::all();
        $control = input::get('restName','');
        $openMeal = DB::table('restaurant')
            ->select('rest_name')
            ->get();
        $rowOpenRest = DB::table('restaurant')
            ->select('rest_name')
            ->where('rest_open', 1)
            ->get();
        if($rowOpenRest != NULL) {
            $openRestName = $rowOpenRest[0]->rest_name;
        }else{
            $openRestName = '目前尚無開餐！';
        }
        if($control == NULL){
            $restPic = '';
            $restName = '';
        }else{
            $openPic = DB::table('restaurant')
                ->select('rest_picture')
                ->where('rest_name', $input['restName'])
                ->get();
                $restPic = $openPic[0]->rest_picture;
                $restName = $input['restName'];
        }

        return view('openMealV', ['openMeal' => $openMeal, 'rowOpenRest' => $rowOpenRest,
            'openRestName' => $openRestName, 'restPic' => $restPic, 'restName' => $restName, 'action' => $action]);
    }
    //今日開餐功能執行
    public function openMealUp()
    {
        $input = Input::all();
        $restName = $input['restName'];
        if ($input['action'] != NULL && $input['action'] == 'open')      //判斷值是否由欄位輸入
        {
            date_default_timezone_set("Asia/Taipei"); //目前時間
            $date = date("Y-m-d");
            $H = $input['openTimeH'];
            $i = $input['openTimeM'];
            $s = '00';
            $closeTime = $date.' '.$H.':'.$i.':'.$s;
        DB::table('menu_order')                      //之前訂餐改為歷史紀錄
        ->update(['pay' => 9]);
        DB::table('restaurant')                      //關閉餐廳
            ->update(['rest_open' => 0]);
        DB::table('restaurant')
            ->where('rest_name', $restName) //開啟今日開餐
            ->update(['rest_open' => 1, 'close_time' => $closeTime]);

            DB::table('restaurant_open')->insert(array(
                array('rest_name' => $restName, 'close_time' => $closeTime)//新增至資料庫
            ));
            return $restName = $input['restName'];
        }else{
            return false;
        }
    }
    //餐廳資料修改
    public function restUpdate()
    {
        $input = Input::all();
        if ($input['action'] != NULL && $input['action'] == 'update')      //判斷值是否由欄位輸入
        {
            $restName=DB::table('restaurant')
                ->select('rest_name')
                ->where('num', $input['num'])
                ->get();
            foreach ($restName as $value){
                $lastRestName = $value->rest_name;
            }
            DB::table('menu')
                ->where('rest_name', $lastRestName)
                ->update(['rest_name' => $input['restName']]);//修改菜單(餐廳名稱)

            DB::table('restaurant')
                ->where('num', $input['num'])
                ->update(['rest_name' => $input['restName'], 'rest_kind' => $input['restKind'],
                    'rest_tel' => $input['restTel']]);//修改餐廳資料

            if (Input::hasFile('rest_picture')) {
                $file = Input::file('rest_picture');                              //取得檔案資訊
                $extension = $file->getClientOriginalExtension();                 //取得檔案副檔名
                $file_name = strval(time()) . str_random(5) . '.' . $extension;   //定義檔案名稱
                $destination_path = public_path() . '/userUpload/';               //定義儲存路徑
                $upload_success = $file->move($destination_path, $file_name);     //移動至指定資料夾
                DB::table('restaurant')
                    ->where('num', $input['num'])
                    ->update(['rest_picture' => $file_name]);
            } else {
                echo "restaurant_img upload failed!";
            }
            return $restName = $input['restName'];
        }else{
            return false;
        }
    }
    //餐廳資料刪除
    public function restDel()
    {
        $input = Input::all();
        if ($input['action'] != NULL && $input['action'] == 'delete')      //判斷值是否由欄位輸入
        {
            DB::table('menu_order')->where('rest_name', '=', $input['restName'])->delete();
            DB::table('menu')->where('rest_name', '=', $input['restName'])->delete();
            DB::table('restaurant')->where('rest_name', '=', $input['restName'])->delete();
            return $restName=$input['restName'];
        }else{
            return false;
        }
    }
}