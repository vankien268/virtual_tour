<?php

namespace App\Providers;

use App\View\Composers\LangComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            ['main','pages.presentation','pages.home', 'cms.Presentation.edit','pages.posts','pages.detail-blog'],
            LangComposer::class
        );
    }
}
