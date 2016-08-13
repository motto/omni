<?php
namespace lib\task\trt;

defined( '_MOTTO' ) or die( 'Restricted access' );


trait Task{

    public function task_futtat()
    {	
        $task=$this->ADT['task'];
       // echo $task;
        if(isset($this->ADT['TSK'][$task]['trt']))
		{$trt=$this->ADT['TSK'][$task]['trt'];}
		else{$trt=[];}
		
			$modnev=$this->ADT['modNev'] ?? 'app';
			$modnev.=$task;
			
			//echo \lib\base\Ob_Trt::str($modnev,$trt);
			if(!class_exists($modnev, false))
			{eval(\lib\base\Ob_TrtS::str($modnev,$trt));}
			
			eval('$'.$modnev.'=new '.$modnev.'();');
			
			$$modnev->ADT=$this->ADT;
		//az alap funkció (Resfunc) előtt lefutó funkció (before)--------	
		    if(isset($this->ADT['TSK'][$task]['before']))
		    {$before_func= $this->ADT['TSK'][$task]['before'] ; $$modnev->$before_func();   }
		 //az alap funkció (Resfunc)-------	   
			$func=$this->func($modnev);
			//echo '$func'.$func;
			if($func=='')
			{$task='';}
			else{
				//eval('$ADT=$'.$modnev.'->'.$func.'();');
				if(isset($this->ADT['TSK'][$task]['eval']))
				{
				    $func=isset($this->ADT['TSK'][$task]['eval']);
				    eval('$'.$modnev.'->'.$func.';');
				}
				else
				{$$modnev->$func();}
								
			}
		//az alap funkció (Resfunc) után lefutó funkció (after)--------	
			if(isset($this->ADT['TSK'][$task]['after']))
			{$after_func= $this->ADT['TSK'][$task]['after'] ; $$modnev->$after_func();   }	
			
    $this->ADT= $$modnev->ADT;  
    }
	public function func($clasnev)
	{
		$func='Res';
		$task=$this->ADT['task'];
		//futtatandó funkció:ADT-ben deklarált, vagy a task név vagy TSK ban deklarált
		if(isset($this->ADT['resfunc']) && method_exists($clasnev,$this->ADT['resfunc'])){$func=$this->ADT['resfunc'];}
		if(method_exists($clasnev,$task)){$func=$task;}
		if(isset($this->ADT['TSK'][$task]['resfunc']) && method_exists($clasnev,$this->ADT['TSK'][$task]['resfunc'])){$func=$this->ADT['TSK'][$task]['resfunc'];}
		
		if($func==''){\GOB::$hiba['Task'][]='nincs a task trait-nek mghívható funkciója';}
		//echo $this->ADT['resfunc'];
		//print_r($this->ADT);
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

	/**
	 ha még nincs,legenerál ehy ADT::$modnev. nevű osztáyt (ha nincs ADT::$modnev vagy ADT::$modnev=''
	 az osztály neve app lesz) ami használja a TSK::$task['trt'] traitet.
	 ugyanilyen névvel példányosítja,
	 ha van $TSK::${$task}['resfunc'] nevű függvénye futtatja azt
	 ha van ADT::$task() nevű függvénye futtatja azt
	 ha nincs akor az ADT::resfunc()-t
	 ha egyik sincs leáll és hibát ír a GOB::hiba['Task'][]-ba
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

/**
ADT kompatibilis ha van POST[$tasknev] nevű adat akkor az lesz a task
 ha nics akkor  GET[$tasknev], ha az sincs akkor a $task
 */
trait Task_PG_GetTask{

 public function GetTask($tasknev='task',$task='alap'){
	    if ($task == 'alap') { $task = $this->ADT['task'] ?? 'alap';}
	    if ($tasknev == 'task') { $tasknev = $this->ADT['tasknev'] ?? 'task';}
	    
		if(isset($_GET[$tasknev])){$task=$_GET[$tasknev];}
		if(isset($_POST[$tasknev])){$task=$_POST[$tasknev];}
		
		if(isset($this->ADT)){$this->ADT['task']=$task;}
		return  $task;
	}

}