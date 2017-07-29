<?php

function vbview($view, $data = array(), $mergeData = array()){
   return VueBridge::view($view, $data, $mergeData);
}