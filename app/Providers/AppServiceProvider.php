<?php

namespace App\Providers;

use App\Models\WebSetting;
use Illuminate\Support\Facades\View;
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
        $header =  WebSetting::where('key', 'logo')->first();
        $favicon = WebSetting::where('key', 'favicon')->first();
        $footer =  WebSetting::where('key', 'footer')->first();
        $classLocation =  WebSetting::where('key', 'classLocation')->first();


        if (count((array)$header)) {
            $data['logo'] = json_decode(@$header->data, true);
        } else {
            $data['logo'] = null;
        }

        if (count((array)$favicon)) {
            $data['favicon'] = json_decode(@$favicon->data, true);
        } else {
            $data['favicon'] = null;
        }

        if (count((array)$footer)) {
            $data['footer'] = json_decode(@$footer->data, true);
        } else {
            $data['footer'] = null;
        }

        // GETTING WEB DESCRIPTION FOR FOOTER 
        $setting = WebSetting::where('status', 1)->where('key', 'contactInfo')->first();
        if (count(array($setting))) {
            $data['contact'] = json_decode(@$setting->data);
        } else {
            $data['contact'] = [];
        }

        
        if (count((array)$classLocation)) {
            $data['classLocation'] = json_decode(@$classLocation->data);
        } else {
            $data['classLocation'] = null;
        }

        // FOR SHARING DATA TO ALL VIEWS
        View::share($data);
    }
}
