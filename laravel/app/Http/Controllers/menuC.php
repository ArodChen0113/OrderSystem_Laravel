<?php
namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Input;
use Illuminate\Http\UploadedFile;

class menuC extends Controller
{

    public function __construct()
    {

    }
    //菜單瀏覽頁面顯示
    public function menuShow()
    {
        $input = Input::all();
        $restData=DB::table('menu')
            ->select('kind','m_num','menu_picture','unit_price')
            ->where('rest_name', $input['restName'])
            ->get();
        $restName=$input['restName'];

        return view('menuV', [ 'restData' => $restData , 'restName' => $restName]);
    }
    //新增餐廳&菜單頁面顯示
    public function restMenuInsertShow()
    {
        $restKind = DB::table('restaurant_kind')
            ->select(DB::raw('rest_kind'))
            ->get();

        return view('restMenuInsertV', ['restKind' => $restKind]);
    }
    //菜單修改頁面顯示
    public function menuUpdateShow()
    {
        $input = Input::all();
        $rest_data=DB::table('menu')
            ->select('kind','m_num','menu_picture','unit_price')
            ->where('m_num', $input['num'])
            ->get();
        $restName=$input['restName'];

        return view('menuUpdateV', [ 'rest_data' => $rest_data,'restName' => $restName]);
    }
    //餐廳&菜單資料新增
    public function restMenuInsert()
    {
        $input = Input::all();
        $restKind = $input['restKind'];
        $kind = $input['kind'];
        $price = $input['price'];
        $restTel = $input['restTel'];
        $restName = $input['restName'];

        if ($input['action'] != NULL && $input['action'] == 'insert')         //判斷值是否由欄位輸入
        {
            if (Input::hasFile('rest_picture')) {
                $file = Input::file('rest_picture');                              //取得檔案資訊
                $extension = $file->getClientOriginalExtension();                 //取得檔案副檔名
                $file_name = strval(time()) . str_random(5) . '.' . $extension;   //定義檔案名稱
                $destination_path = public_path() . '/userUpload/';               //定義儲存路徑
                $upload_success = $file->move($destination_path, $file_name);     //移動至指定資料夾
                DB::table('restaurant')->insert(array(                            //新增餐廳資料
                    array('rest_name' => $restName, 'rest_kind' => $restKind, 'rest_tel' => $restTel, 'rest_picture' => $file_name)
                ));
            } else {
                echo "restaurant_img upload failed!";
            }

            $row_file = Input::file('menu_picture');
            $row_file = array_filter($row_file);
            $kind = array_filter($kind);
            $num = count($kind);
            for ($i = 0; $i <= $num - 1; $i++) {
                $file2=$row_file[$i];
                if (Input::hasFile('menu_picture')) {
                    $extension2 = $file2->getClientOriginalExtension();
                    $file_name2 = strval(time()) . str_random(5) . '.' . $extension2;
                    $destination_path2 = public_path() . '/userUpload/';
                    $upload_success2 = $file2->move($destination_path2, $file_name2);
                    DB::table('menu')->insert(array(                           //新增菜單資料
                        array('rest_name' => $restName, 'kind' => $kind[$i], 'unit_price' => $price[$i],'menu_picture'=> $file_name2)
                    ));
                } else {
                    echo "menu_img upload failed!";
                }
            }
            header("Location:restChooseV");
        }
    }
    //菜單資料修改
    public function menuUpdate()
    {
        $input = Input::all();
        if ($input['action'] != NULL && $input['action'] == 'update')      //判斷值是否由欄位輸入
        {
            DB::table('menu')
                ->where('m_num', $input['num'])
                ->update(['kind' => $input['kind'],'unit_price' => $input['price']]);

            if (Input::hasFile('menu_picture')) {
                $file = Input::file('menu_picture');                              //取得檔案資訊
                $extension = $file->getClientOriginalExtension();                 //取得檔案副檔名
                $file_name = strval(time()) . str_random(5) . '.' . $extension;   //定義檔案名稱
                $destination_path = public_path() . '/userUpload/';               //定義儲存路徑
                $upload_success = $file->move($destination_path, $file_name);     //移動至指定資料夾
                DB::table('menu')
                    ->where('m_num', $input['num'])
                    ->update(['menu_picture' => $file_name]);
            } else {
                echo "menu_img upload failed!";
            }
        }
        $restName=$input['restName'];
        header("Location:menuV?restName=$restName");

    }
    //菜單資料刪除
    public function menuDel()
    {
        $input = Input::all();
        if ($input['action'] != NULL && $input['action'] == 'delete')      //判斷值是否由欄位輸入
        {
            DB::table('menu')->where('m_num', '=', $input['num'])->delete();
        }
        $restName=$input['restName'];
        header("Location:restChooseV?restName=$restName");
    }

}