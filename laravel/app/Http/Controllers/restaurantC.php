<?php
namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Input;

class restaurantC extends Controller
{
    public function __construct()
    {

    }
    //餐廳選擇器顯示
    public function restChooseShow()
    {
        $rest_kind_echo = DB::table('restaurant_kind')
            ->select(DB::raw('rest_kind'))
            ->get();
        $todayopen=DB::table('restaurant')
            ->select('rest_name')
            ->where('rest_open', '==', 1)
            ->get();

        return view('restChooseV', ['rest_kind_echo' => $rest_kind_echo,'todayopen' =>$todayopen]);
    }
    //餐廳管理頁面顯示
    public function restManageShow()
    {
        $input = Input::all();
        $rest_data=DB::table('restaurant')
            ->where('rest_name', $input['select_restName'])
            ->get();
        foreach ($rest_data as $i)
        {
            $restname=$i->rest_name;
            $restkind=$i->rest_kind;
            $resttel=$i->rest_tel;
            $restpic=$i->rest_picture;
            $restnum=$i->num;
        }

        return view('restManageV', ['restname' => $restname,'restkind' => $restkind,'resttel' => $resttel,'restpic' => $restpic,'restnum' => $restnum]);
    }
    //今日開餐頁面顯示
    public function openMealShow()
    {
        $openMeal=DB::table('restaurant')
            ->select('rest_name')
            ->get();

        return view('openMealV', ['openMeal' => $openMeal]);
    }
    //今日開餐頁面顯示2
    public function openMealShow2()
    {
        $input = Input::all();
        $openMeal=DB::table('restaurant')
            ->select('rest_name')
            ->get();
        $openPic=DB::table('restaurant')
            ->select('rest_picture')
            ->where('rest_name', $input['select1'])
            ->get();
        foreach ($openPic as $i)
        {
            $restpic=$i->rest_picture;
        }
        $rest_name=$input['select1'];

        return view('openMealV2', ['openMeal' => $openMeal,'restpic' => $restpic, 'rest_name' => $rest_name]);
    }
    //今日開餐功能執行
    public function openMealUp()
    {
        $input = Input::all();
        DB::table('menu_order')                      //之前訂餐改為歷史紀錄
        ->update(['pay' => 9]);
        DB::table('restaurant')                      //關閉餐廳
            ->update(['rest_open' => 0]);
        DB::table('restaurant')
            ->where('rest_name', $input['restName']) //開啟今日開餐
            ->update(['rest_open' => 1]);

        header("Location:restChooseV");
    }
    //餐廳資料修改
    public function restUpdate()
    {
        $input = Input::all();
        if ($input['action'] != NULL && $input['action'] == 'update')      //判斷值是否由欄位輸入
        {
            DB::table('restaurant')
                ->where('num', $input['num'])
                ->update(['rest_name' => $input['rest_name'],'rest_kind' => $input['rest_kind'],'rest_tel' => $input['rest_tel']]);

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
        }
        header("Location:restChooseV");
    }
    //餐廳資料刪除
    public function restDel()
    {
        $input = Input::all();
        if ($input['action'] != NULL && $input['action'] == 'delete')      //判斷值是否由欄位輸入
        {
            DB::table('menu_order')->where('rest_name', '=', $input['restname'])->delete();
            DB::table('menu')->where('rest_name', '=', $input['restname'])->delete();
            DB::table('restaurant')->where('rest_name', '=', $input['restname'])->delete();
        }
        header("Location:restChooseV");
    }
}