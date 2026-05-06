<?php

namespace App\Providers;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    View::composer('*', function ($view) {
            $menuFile = 'admin.json';
            if (Auth::check() && Auth::user()->role === 'Employee') {
                $menuFile = 'employee.json';
            }
            if (Auth::check() && Auth::user()->role === 'Hr') {
                $menuFile = 'hr.json';
            }
            $menuJson = file_get_contents(base_path("resources/menu/{$menuFile}"));
            $menuData = json_decode($menuJson);
            $view->with('menuData', [$menuData]);
        });
  }
}
