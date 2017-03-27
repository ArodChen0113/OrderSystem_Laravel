<?php
namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;

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
    public function restMenuInsert($rest_kind,$rest_name,$rest_tel,$restpic_tmpname,$restpic_name,$kind,$price,$menu_tmpname,$menu_name,$action)
    {
        if ($action != NULL && $action == 'insert')      //判斷值是否由欄位輸入
        {
            if (!move_uploaded_file($restpic_tmpname, "../photo/".$restpic_name)) {        //執行菜單圖片上傳
                echo "Upload false!";
            } else {
                DB::table('restaurant')->insert(array(
                    array('rest_name' => $rest_name, 'votes' => 0),
                    array('rest_kind' => $rest_kind, 'votes' => 0),
                    array('rest_tel' => $rest_tel, 'votes' => 0),
                    array('rest_picture' => $restpic_name, 'votes' => 0)
                ));
            }
            $k=0;
            $kind = array_filter($kind);
            $num=count($kind);
            echo $num;
            for ($i=1;$i<=$num;$i++) {
                if (!move_uploaded_file($menu_tmpname[$k], "../photo/".$menu_name[$k])) {  //執行菜單圖片上傳
                    echo "Upload false!";
                } else {
                    DB::table('menu')->insert(array(
                        array('rest_name' => $rest_name, 'votes' => 0),
                        array('kind' => $kind[$k], 'votes' => 0),
                        array('unit_price' => $price[$k], 'votes' => 0),
                        array('menu_picture' => $menu_name[$k], 'votes' => 0),
                        array('date' => NOW(), 'votes' => 0)
                    ));
                    $k++;
                }
            }
            header("Location:../restaurant_index.php");
        }
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