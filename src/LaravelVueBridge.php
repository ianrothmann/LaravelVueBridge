<?php
/**
 * Created by PhpStorm.
 * User: ian
 * Date: 2017/04/12
 * Time: 10:21 AM
 */

namespace IanRothmann\LaravelVueBridge;


use Illuminate\Support\Facades\Route;

class LaravelVueBridge
{
    use ExposeRoutes;
    use ExposeVariables;

    private $pagescripts=[];

    public function __construct()
    {

    }

    public function test(){
        dd('HALo d');
    }

    function view($view,$data=[],$mergeData=[]){
        $this->exposeVariables($data)
            ->pageScript(str_replace('.','/',$view).'.js');
        return view($view,$data,$mergeData);
    }

    public function pageScript($scriptpath){
        $this->pagescripts[]=$scriptpath;
        return $this;
    }


    public function scripts($defined_vars){
        $export_routes=json_encode($this->getExposedRoutes());
        $export_vars=json_encode($this->getExposedVariables($defined_vars));

        $session_status='';
        if(session('error')){
            $session_status='const sessionStatus={message:"'.str_replace('"','\"',session('error')).'",messagetype:"error"};';
        }elseif(session('warning')){
            $session_status='const sessionStatus={message:"'.str_replace('"','\"',session('warning')).'",messagetype:"warning"};';
        }elseif(session('status')){
            $session_status='const sessionStatus={message:"'.str_replace('"','\"',session('status')).'",messagetype:"status"};';
        }

        $js=<<<TOC
<script type="text/javascript">
   const routeActions = $export_routes;
   const pageData=$export_vars;
   $session_status
</script>
TOC;

        foreach ($this->pagescripts as $script) {
            $js.='<script src="'.mix('js/pages/'.$script).'"></script>';
        }

        return $js;
    }
}