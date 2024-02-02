<?php

namespace App\Providers;

use App\Providers\Concern\HasMacros;
use App\View\Components\cms\text;
use App\View\Components\cms\select;
use App\View\Components\cms\checkbox;
use App\View\Components\Notification;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    use HasMacros;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerWhereLikeMacroToBuilder();
        Blade::component('text', text::class);
        Blade::component('notif', Notification::class);
        Blade::component('select', select::class);
        Blade::component('checkbox', checkbox::class);
        Blade::directive('currency', function ( $expression ) { return "Rp. <?php echo number_format($expression,0,',','.'); ?>"; });

    }
}
