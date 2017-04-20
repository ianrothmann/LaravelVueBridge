<?php
/**
 * Created by PhpStorm.
 * User: ian
 * Date: 2017/04/12
 * Time: 12:50 PM
 */

namespace IanRothmann\LaravelVueBridge\Facades;


use Illuminate\Support\Facades\Facade;

class VueBridge extends Facade
{
    public static function getFacadeAccessor(){
        return 'vue-bridge';
    }
}