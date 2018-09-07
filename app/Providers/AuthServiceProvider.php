<?php

namespace App\Providers;

use App\AdminPermissions;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',

        'App\Posts' => 'App\Policies\PostsPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        $permissions = AdminPermissions::all();
        foreach ($permissions as $permission){
            Gate::define($permission->name,function($users) use ($permission){
                return $users->hasPermission($permission);
            });
        }
    }
}
