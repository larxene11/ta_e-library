<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use Illuminate\Auth\Access\Response;
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
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('Is_pegawai', function (User $user) {
            return $user->level == "pegawai"
            ? Response::allow()
            : Response::deny('Kamu Harus Menjadi Pegawai.');
        });

        Gate::define('Is_siswa', function (User $user) {
            return $user->level == "siswa"
            ? Response::allow()
            : Response::denyWithStatus(403);
        });
    }
}
