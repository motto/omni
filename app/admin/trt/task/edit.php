<?php
namespace mod\login\trt\task;

defined('_MOTTO') or die('Restricted access');

trait Edit{

public function Edit()
    {   
        $task=$this->ADT['task'];
        $this->ADT['TSK'][$task]['next']=$hibaTask;
        $ql="SELECT * FROM ".$this->ADT['tablanev']." WHERE id='".$this->ADT['idT'][0]."'";
        $this->ADT['dataT']=\lib\db\DB::assoc_sor($sql);
      
    }

}