<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isPegawai', function (User $user) {
            return $user->level == 'pegawai'
                ? Response::allow()
                : Response::deny('Kamu Harus Merupakan Pegawai.');
        });

        Gate::define('isAdmin', function (User $user) {
            return $user->level == 'admin'
                ? Response::allow()
                : Response::deny('Kamu Harus Merupakan Admin.');
        });

        Gate::define('isSiswa', function (User $user) {
            return $user->level == 'siswa'
                ? Response::allow()
                : Response::denyWithStatus(403);
        });
    }
}