<?php
namespace mod\login\trt\task;

defined('_MOTTO') or die('Restricted access');
// LT: Save_succes,database_err
class Save_S{
  static   public function SaveFromSPT($ADT,$err='database_err')
    {
        $id=$ADT['idT'][0] ?? 0;
        $task=$ADT['task'];
        $ADT['saveRes']=true;
        if(isset($ADT['TSK'][$task]['noSave']))
        {
          foreach($ADT['SPT'] as $key=>$value)
          {
               if(!in_array($key,$ADT['TSK'][$task]['noSave']))
               {      
                $saveT[$key]=$value; 
               }  
          }
        }else{$saveT=$ADT['SPT'];}
        
        if($id==0)
        {
         $beszurtid=\lib\db\DBA::beszur_tombbol($ADT['tablanev'],$saveT);
            if($beszurtid==0)
            {
                $ADT['saveRes']=false;
                $ADT['LT']=\lib\base\TOMB::langTextToT('err',$err,$ADT['LT']);               
            }
           else{$ADT['id']=$beszurtid;}    
        }
        else 
        {   
            if(!\lib\db\DBA::frissit_tombbol($ADT['tablanev'],$id,$saveT))
            {
                $ADT['saveRes']=false;
                $ADT['LT']=\lib\base\TOMB::langTextToT('err',$err,$ADT['LT']);
            }
            
        }    
 return $ADT ;
    }    
    
}
trait Save_base{
use \mod\login\trt\Ell;
public function Save_base($hibaTask,$info)
    {   
        $task=$this->ADT['task'];
        $this->ADT['TSK'][$task]['next']=$hibaTask;
        

        if ($this->Ell()) {

            $this->ADT=\mod\login\trt\task\Save_S::SaveFromSPT($this->ADT) ;
             
            if ($this->ADT['saveRes']) {
                 
                $this->ADT['LT'] =\lib\base\TOMB::langTextToT('info',$info,$this->ADT['LT']);
                $this->ADT['TSK'][$task]['next']='alap';
            }
             
        }
    }

}

trait Save{ 
use \mod\login\trt\task\Save_base;

public function Save()
{
    $this->Save_base('form','Save_succes');

}

}
