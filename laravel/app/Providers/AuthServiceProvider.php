<?php

namespace App\Providers;

use DB;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        $gate->define('update-post', function ($user, $post) {
            return $user->id === $post->user_id;
        });
    }

    public function Authority(){
        $user = Auth::user();
        $loginName = $user->name;
        $rowCheck = DB::table('member')
            ->select('authority')
            ->where('name', $loginName)
            ->get();
        $checkLevel=$rowCheck[0]->authority;
        if($checkLevel==0){
            return view('noAuthV');
        }
    }
}
