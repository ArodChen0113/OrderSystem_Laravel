<?php

namespace App\Http\Controllers\Auth;

use DB;
use App\User;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $redirectAfterLogout = '/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:member',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    /**
     * 重導使用者到 GitHub 認證頁。
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * 從 Github 得到使用者資訊
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();

        // $user->token;
    }

//    protected function login(){
//        $input = Input::all();
//        $pPw=0;
//        $u_ac = DB::table('member')//查詢之前訂購總額
//        ->select('account','password')
//            ->where('account', $input['email'])
//            ->get();
//        foreach ($u_ac as $i){
//            $pAc=$i->account;
//            $pPw=$i->password;
//        }
//        if($pPw==$input['password']&&$pPw!=0){
//            header("Location:/");
//        }else{
//            $errors="帳號或密碼錯誤！";
//            return view('/home', ['errors' => $errors]);
//        }
//
//    }
//
//    protected function register(){
//        $input = Input::all();
//        date_default_timezone_set("Asia/Taipei"); //目前時間
//        $date=date("Y-m-d h:i:s");
//        DB::table('member')->insert(array(                            //新增餐廳資料
//            array('account' => $input['email'], 'password' => $input['password'], 'u_name' => $input['name'],'date' => $date)
//        ));
//        header("Location:/home");
//    }
}
