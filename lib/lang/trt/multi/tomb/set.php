<?php
namespace lib\lang\trt\multi\tomb;
defined( '_MOTTO' ) or die( 'Restricted access' );
/**
ADT kompatibilis 
 */
trait Set_SetLT{

    public function SetLT($langT=[]){
    /*if ($langT == 'alap') { $langT = $this->ADT['langT'] ?? [];}
	
        eval('$LT=\mod\\'.$modname.'\LT::$'.\CONF::$accepted_langT[0].';');
      if ($tasknev == 'task') { $tasknev = $this->ADT['tasknev'] ?? 'task';}
        return $LT;*/
    }
    public function getAppLT($appname=''){
        $LT=[];
        eval('$LT=\app\\'.$appname.'\LT::$single;');
        return $LT;
    }
}
