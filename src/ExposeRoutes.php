<?php
/**
 * Created by PhpStorm.
 * User: ian
 * Date: 2017/04/12
 * Time: 10:21 AM
 */

namespace IanRothmann\LaravelVueBridge;


use Illuminate\Support\Facades\Route;

trait ExposeRoutes
{
    protected $routes=[
        'all'=>false,
        'none'=>true,
        'only'=>[],
        'without'=>[],
    ];

    public function exposeAllRoutes(){
        $this->routes['all']=true;
        return $this;
    }

    public function hideRoutes($routeOrArray){
        $this->routes['all']=true;
        if(is_array($routeOrArray)){
            $this->routes['without']=$routeOrArray;
        }else{
            $this->routes['without'][]=$routeOrArray;
        }
        return $this;
    }

    public function exposeRoutes($routeOrArray){
        $this->routes['none']=true;
        if(is_array($routeOrArray)){
            $this->routes['only']=$routeOrArray;
        }else{
            $this->routes['only'][]=$routeOrArray;
        }
        return $this;
    }

    private function routeExposed($route){
        return ($this->routes['all']&&!array_key_exists($route,$this->routes['without']))
            || ($this->routes['none']&&array_key_exists($route,$this->routes['only']));
    }

    private function getExposedRoutes(){
        $app = app();
        $routes = $app->routes->getRoutes();
        $exportRoutes=[];
        foreach ($routes as $route){
            if(array_key_exists('as',$route->action)&&$this->routeExposed($route->action['as'])){ //only named routes
                $exportRoutes[$route->action['as']]=[
                    'method'=>$route->methods[0],
                    'url'=>'/'.$route->uri
                ];
            }
        }

        return $exportRoutes;
    }

}