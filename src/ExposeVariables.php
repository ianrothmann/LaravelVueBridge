<?php
/**
 * Created by PhpStorm.
 * User: ian
 * Date: 2017/04/12
 * Time: 10:21 AM
 */

namespace IanRothmann\LaravelVueBridge;


use Illuminate\Support\Facades\Route;

trait ExposeVariables
{
    protected $vars=[
        'all'=>false,
        'none'=>true,
        'only'=>[],
        'without'=>[],
    ];

    public function exposeAllVariables(){
        $this->vars['all']=true;
        return $this;
    }

    public function hideAllVariables(){
        $this->vars['all']=true;
        return $this;
    }

    public function hideVariables($varOrArray){
        $this->vars['all']=true;
        if(is_array($varOrArray)){
            $this->vars['without']=$varOrArray;
        }else{
            $this->vars['without'][]=$varOrArray;
        }
        return $this;
    }

    public function exposeVariables($varOrArray){
        $this->vars['none']=true;
        if(is_array($varOrArray)){
            $this->vars['only']=$varOrArray;
        }else{
            $this->vars['only'][]=$varOrArray;
        }

        return $this;
    }

    private function variableExposed($var){
        return ($this->vars['all']&&!array_key_exists($var,$this->vars['without']))
            || ($this->vars['none']&&array_key_exists($var,$this->vars['only']))
            || ($this->vars['all']&&!in_array($var,$this->vars['without']))
            || ($this->vars['none']&&in_array($var,$this->vars['only']));
    }

    private function getExposedVariables($exposed_vars){

        foreach ($exposed_vars as $key=>$var){

            if(!$this->variableExposed($key)||strpos($key,'__')!==FALSE)
                unset($exposed_vars[$key]);
        }

        return $exposed_vars;
    }

}