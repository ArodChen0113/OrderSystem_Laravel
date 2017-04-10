<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function Authority()
    {
        $user = Auth::user();
        $loginName = $user->name;
        $rowCheck = DB::table('member')
            ->select('authority')
            ->where('name', $loginName)
            ->get();
        $checkLevel = $rowCheck[0]->authority;
        if ($checkLevel == 0) {
            header("Location:noAuthV");
        }
    }
    public function AuthUrl()
    {
        return view('noAuthV');
    }
}
