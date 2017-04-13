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

class errorC extends Controller
{

    public function __construct()
    {
        $this -> middleware('auth'); //驗證使用者是否登入
    }
    //尚未開餐頁面顯示
    public function noRestOpenShow()
    {
        return view('noRestOpenV');
    }

}