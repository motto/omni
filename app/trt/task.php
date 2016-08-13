<?php
namespace lib\task\trt;

defined( '_MOTTO' ) or die( 'Restricted access' );
trait Task_SetTask {
    public function SetTask($tasknev='task'){
  $task=$_GET[$tasknev] ?? 'alap';     
  $task=$_POST[$tasknev] ?? $task; 
  if(!$this->GetJog()){$task='joghiba';}
}}
trait Task {

    public function task_futtat()
    {
        $task=$this->ADT['task'];
        
        $trt=$this->trt();
        
        $classnev=$this->ADT['appdNev'] ?? 'app'.$task;

        if(!class_exists($classnev, false))
        {eval(\lib\base\Ob_TrtS::str($classnev,$trt));}
        	
        eval('$'.$classnev.'=new '.$classnev.'();');
        	
        $$classnev->ADT=$this->ADT;
        
        //az alap funkció (Resfunc) előtt lefutó funkció (before)--------
        if(isset($this->ADT['TSK'][$task]['before']))
        {$before_func= $this->ADT['TSK'][$task]['before'] ; $$classnev->$before_func();   }
       
        //az alap funkció (Resfunc)-------
        $func=$this->func($classnev);
        //echo '$func'.$func;
        if($func=='')
        {$task='';}
        else{
            //eval('$ADT=$'.$modnev.'->'.$func.'();');
            if(isset($this->ADT['TSK'][$task]['eval']))
            {
                $func=isset($this->ADT['TSK'][$task]['eval']);
                eval('$'.$classnev.'->'.$func.';');
            }
            else
            {$$classnev->$func();}

        }
        
        //az alap funkció (Resfunc) után lefutó funkció (after)--------
        if(isset($this->ADT['TSK'][$task]['after']))
        {$after_func= $this->ADT['TSK'][$task]['after'] ; $$classnev->$after_func();   }
        	
        $this->ADT= $$classnev->ADT;
    }
    public function func($clasnev)
    {
        $func='Res';
        $task=$this->ADT['task'];
        //futtatandó funkció:ADT-ben deklarált, vagy a task név vagy TSK ban deklarált
        if(isset($this->ADT['resfunc']) && method_exists($clasnev,$this->ADT['resfunc'])){$func=$this->ADT['resfunc'];}
        if(method_exists($clasnev,$task)){$func=$task;}
        if(isset($this->ADT['TSK'][$task]['resfunc']) && method_exists($clasnev,$this->ADT['TSK'][$task]['resfunc'])){$func=$this->ADT['TSK'][$task]['resfunc'];}

        if($func==''){\GOB::$logT['Task'][]='nincs a task trait-nek mghívható funkciója';}
        return $func;
    }
    public function next()
    {
        $task=$this->ADT['task'];
    
        if(isset($this->ADT['TSK'][$task]['next']) )
        {$task=$this->ADT['TSK'][$task]['next'];
        }else{$task='';}
    
        $this->ADT['task']=$task;
    }
    public function trt()
    {   $res=[];
        $task=$this->ADT['task'];
        $trt=$this->ADT['TSK'][$task]['trt'] ?? [];
     
        foreach($trt as $t){
          $res[]=\TRT::$$t ?? $t; 
        }
      return $res;  
    }
    
    /**
     ha még nincs,legenerál ehy ADT::$ppNev.$task nevű osztáyt 
     (ha nincs ADT::$appnev akkor  app.$task) ami használja a TSK::$task['trt'] traitet.
     ugyanilyen névvel példányosítja,
     ha van $TSK::${$task}['resfunc'] nevű függvénye futtatja azt
     ha van ADT::$task() nevű függvénye futtatja azt
     ha nincs akor az ADT::resfunc()-t
     ha egyik sincs leáll és hibát ír a GOB::logT'Task'][]-ba
     a függvények visszatérési értékének az új ADT-nek kell lenni.
     ezzel hívja meg újra saját magát de a task az  ADT::$next lesz
     ha nincs akkor TSK::$next ha ez sincs akkor nem hívja meg magát.
     */
    public function Task()
    {

        while ($this->ADT['task']!='')
        {
            ///echo $task;
            $this->task_futtat();
            $this->next();
            	
        }

    }


}