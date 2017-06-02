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

        return view('userEvaluationV', ['orderData' => $orderData, 'todayOpen' => $todayOpen]);
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
    //今日開餐評價資料新增
    public function evaluationInsert()
    {
        $input = Input::all();
        $starValue = Input::get('value', '');
        if($starValue != NULL){

            $user = Auth::user();                        //使用者名稱
            $orderName = $user->name;
            $starValue = explode(",", $input['value']);   //分割字串(評價值)
            $mNum = explode(",", $input['js_mNum']);      //分割字串(菜單編號)

            $todayOpen = DB::table('restaurant')         //查詢今日開餐餐廳名稱&分數
            ->select('rest_name','r_star')
                ->where('rest_open', 1)
                ->get();
            $openRestName = $todayOpen[0]->rest_name;
            $openRestStar = $todayOpen[0]->r_star;
            date_default_timezone_set("Asia/Taipei");    //目前時間
            $date = date("Y-m-d H:i:s");

            $count = count($mNum);
            for($i=0 ; $i<=$count-1 ; $i++) {
                $rowOrderKind = DB::table('menu')        //評價菜單
                ->select('kind')
                    ->where('m_num', $mNum[$i])
                    ->get();
                $orderKind = $rowOrderKind[0]->kind;
                DB::table('menu_evaluation')->insert(array(
                    array('name' => $orderName, 'rest_name' => $openRestName, 'kind' => $orderKind,
                        'm_star' => $starValue[$i], 'date' => $date)//新增顧客評價
                ));

                $rowMenuStar = DB::table('menu')         //查詢之前菜色分數
                ->select('m_star')
                    ->where('m_num', $mNum[$i])
                    ->get();
                $menuStar = $rowMenuStar[0]->m_star;
                if($menuStar != 0) {
                    $upMStar = ($menuStar + $starValue[$i]) / 2;    //計算菜色分數
                }else{
                    $upMStar = $starValue[$i];
                }
                DB::table('menu')                        //更新菜色分數
                ->where('m_num', $mNum[$i])
                    ->update(['m_star' => $upMStar]);
            }
            DB::table('rest_evaluation')->insert(array(
                array('name' => $orderName, 'rest_Name' => $openRestName, 'r_star' => $starValue[$count],
                    'date' => $date)//新增至資料庫
            ));

            if($openRestStar != 0) {
                $upRStar = ($openRestStar + $starValue[$count]) / 2;    //計算餐廳分數
            }else{
                $upRStar = $starValue[$count];
            }

            DB::table('restaurant')                        //更新餐廳分數
            ->where('rest_name', $openRestName)
                ->update(['r_star' => $upRStar]);

            header("Location:purchaseManageV?action=evaInt");
        }else{
            return false;
        }
    }
}