<?php

namespace App\Providers;

use App\Models\CartItem;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Ensure view bindings are ready
        $this->app->booted(function () {
            View::composer('*', function ($view) {
                if (auth()->check()) {
                    $itemCount = CartItem::where('user_id', auth()->id())->sum('quantity');
                } else {
                    $itemCount = 0;
                }
                
                $view->with('cartItemCount', $itemCount);
            });
        });
    }
}
