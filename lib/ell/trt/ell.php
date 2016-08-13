<?php
namespace lib\ell\trt;

defined( '_MOTTO' ) or die( 'Restricted access' );
trait Ell_Match{
	public  function Match($val2,$err='no_match',$changeT=[])
	{	$res=[];$res['bool']=true;
	if($this->val!=$val2){ $res['bool'] = false; $res['err']=[$err,$changeT];}
	return $res;
	}}

/**
az LT tömböt már előtte fel kell tölteni! onnan veszi a hiba üzenetet
 */
trait Ell{
public $val='';	

public  function Ell($get=false)
{	
$task=$this->ADT['task'];
$ellT=$this->ADT['TSK'][$task]['ell'];

foreach ($ellT as $valnev=>$param)
{
    $valbool=true;
    $value='nincsilyenvalue';
    if($get && isset($_GET[$valnev])){$value=$_GET[$valnev] ;}
    if(isset($_POST[$valnev])){$value=$_POST[$valnev] ;}
	if($value!='nincsilyenvalue')
	{
	    $this->val=$value;
//echo 'ggggg'.$this->val;
    	foreach ($param as $func=>$par)
    	{
    		if($func=='regx')
    		{		
    			foreach ($par as $parT)
    			{
        			$res=$this->regx($parT); 
//print_r($res);
    			}    			
    		}
    		else
    		{
    			if($par!=''){eval('$res=$this->'.$func.'('.$par.');');}
    			else{eval('$res=$this->'.$func.'();');}		
    		} 
    		
    		if(!$res['bool'])
    		{
    		    $this->errToLT($res); 
    		    $this->ADT['ellerr']=false;
    		    $valbool=false;//azért kell külön változó 
    		    // hogy csa a hibás adatot ne írja be az SPT-be
    		    //Az ADT['ellerr'] az összes hátralevőt letiltaná
    		}
           		
    	}
	}
	
	if($valbool) {$this->ADT['SPT'][$valnev]=$this->val;}
		
}
return $this->ADT['ellerr'];
}
public function textToLT($key,$text,$changeT){
    $lt=$this->ADT['LT'] ?? [];
    $this->ADT['LT']=\lib\base\TOMB::langTextToT($key,$text,$lt,$changeT);   
}
/**
szöveget cserél ki az LT tömb mgfelelőjére paraméterezhető a cserélendő paramétert 
<< >> jelek közé kell tenni az értéküket a change assoc tömbben kell megadni 
ha az érték 'LT.' -al ketdődik azt is becseréli a az LT tömb megfelelő elemével
 */
public function errToLT($errT){

	foreach ($errT as $nev =>$value)
	{
	    if($nev!='bool')
	    {  
//echo 'textToLT: '.$nev;
//print_r($value);
            if(is_array($value) && !empty($value))
            {
                $val=$value[0]; $changeT=$value[1] ?? [];
            }
    	    else
    	    {
    	        $val=$value;$changeT=[];
    	    }
    	     
        	    if(!empty($val)){ $this->textToLT($nev,$val,$changeT) ; }	   
	   }
    
    }
}}
