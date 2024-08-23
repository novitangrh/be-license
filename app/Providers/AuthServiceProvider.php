<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\FYP\MappingApplicationRole;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

// use App\Models\SITU\Scope;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $var = array();
        $list = MappingApplicationRole::GetRolesByApplicationId(1);
        foreach ($list as $key => $val) {
            $var[$val['scope_name']] = $val['role_name'];
        }
        Passport::tokensCan($var);
    }
}
