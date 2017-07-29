<?php
/**
 * Created by PhpStorm.
 * User: ian
 * Date: 2017/04/12
 * Time: 10:21 AM
 */

namespace IanRothmann\LaravelVueBridge;


use Illuminate\Support\Facades\Route;

trait ExposeClosure
{

    private $closures=[];

    public function exposeClosureResult($varName,$closure){
        if($closure instanceof \Closure) {
            $this->closures[$varName] = $closure;
        }
    }

    private function getClosureVariables(){

        $data=[];
        foreach ($this->closures as $varName=>$closure){
            $data[$varName]=$closure();
        }

        return $data;
    }

}