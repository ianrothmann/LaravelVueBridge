<?php
/**
 * Created by PhpStorm.
 * User: ian
 * Date: 2017/04/12
 * Time: 12:52 PM
 */

namespace IanRothmann\LaravelVueBridge\ServiceProviders;


use Illuminate\Support\ServiceProvider;

class VueBridgeServiceProvider extends ServiceProvider
{
    public function register(){
        $this->app->bind('vue-bridge','IanRothmann\LaravelVueBridge\LaravelVueBridge');

    }


}