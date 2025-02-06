<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The namespace for the controller routes.
     *
     * @var string|null
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace) // If namespace is used
            ->group(base_path('routes/api.php'));
    }
    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // parent::boot(); // Removed as ServiceProvider does not have a boot method
        $this->mapApiRoutes(); // Ensure this is present
    }
}
