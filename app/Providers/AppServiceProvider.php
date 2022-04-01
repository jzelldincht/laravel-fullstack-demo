<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
        // 只能是中文
        Validator::extend('chs', function($attribute, $value, $parameters, $validator) {
            $chs_regex = '/^[\x{4e00}-\x{9fa5}]+$/u';
            return preg_match($chs_regex, $value);
        });

        // 只能是中文
        Validator::extend('is_positive_integer', function($attribute, $value, $parameters, $validator) {
            $chs_regex = '/^\d+$/i';
            return preg_match($chs_regex, $value);
        });
    }
}
