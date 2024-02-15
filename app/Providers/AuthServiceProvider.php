<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Invoice;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
       /*  Invoice::class => InvoicePolicy::class, */
        'App\Models\Invoice' => 'App\Policies\InvoicePolicy',

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('can-edit', function(User $user, Invoice $invoice){
            
            if ($user->id == $invoice->user_id) {
               return Response::allow();
            }

            return Response::deny('Blocked');
        });
    }
}
