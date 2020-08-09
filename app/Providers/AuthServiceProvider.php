<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Model\admin;
use App\Policies\LoaiPhongPolicy;
use Illuminate\Http\Request;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        loai_phong::class => LoaiPhongPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function($admin) {
            if($admin->level == '1') {
                return true;
                }
        });

        Gate::define('view',function($user){
            
            return $user->level==1;
        });

        Gate::define('update', function ($admin) {
            return $admin->level == 1;
        });

        Gate::define('insert', function ($user) {
            return $user->level == 1;
        });

         Gate::define('delete', function ($user) {
            return $user->level == 1;
        });

    }
}
