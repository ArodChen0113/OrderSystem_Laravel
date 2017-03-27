<?php
namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Input;

class menuC extends Controller
{

    public function __construct()
    {

    }
    //菜單瀏覽頁面顯示
    public function menuShow()
    {

    }
    //新增餐廳&菜單頁面顯示
    public function restMenuInsertShow()
    {
        $result = DB::table('restaurant_kind')
            ->select(DB::raw('rest_kind'))
            ->get();
        return view('restMenuInsertV', ['result' => $result]);
    }
    //菜單修改頁面顯示
    public function menuUpdateShow()
    {

    }
    //餐廳&菜單資料新增
    public function restMenuInsert()
    {
        $input = Input::all();
        $rest_kind = $input['restkind'];
        $kind = $input['kind'];
        $price = $input['price'];
//        $menu_tmpname= Input::file('menu_picture')->getRealPath();
//        $menu_name = Input::file('menu_picture')->getClientOriginalName();
        $restpic_name = Input::file('rest_picture')->getClientOriginalName();
//        $restpic_tmpname = Input::file('rest_picture')->getRealPath();
        $rest_tel = $input['rest_tel'];
        $rest_name = $input['restaurant_name'];

        if ($input['action'] != NULL && $input['action'] == 'insert')      //判斷值是否由欄位輸入
        {
//            $destinationPath = base_path() . '../photo';
//            Input::file('photo')->move($destinationPath, $restpic_name);
                DB::table('restaurant')->insert(array(
                    array('rest_name' => $rest_name,'rest_kind' => $rest_kind,'rest_tel' => $rest_tel, 'rest_picture' => $restpic_name)
                ));
            }
            $k=0;
            $kind = array_filter($kind);
            $num=count($kind);
            echo $num;
            for ($i=1;$i<=$num;$i++) {
//                if (!move_uploaded_file($menu_tmpname[$k], "../photo/".$menu_name[$k])) {  //執行菜單圖片上傳
//                    echo "Upload false!";
//                } else {
                    DB::table('menu')->insert(array(
                        array('rest_name' => $rest_name,'kind' => $kind[$k],'unit_price' => $price[$k])
                    ));
                    $k++;
                }
            header("Location:restMenuInsert");
        }

    //菜單資料修改
    public function menuUpdate()
    {

    }
    //菜單資料刪除
    public function menuDel()
    {

    }

}