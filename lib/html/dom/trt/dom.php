<?php
namespace lib\html\dom\trt;
 // pl.: mod\login;
defined('_MOTTO') or die('Restricted access');

/**
 * ADT kompatibilis.
 */
trait Dom_ChangeLT
{
    public function ChangeLT($view='', $LT = [])
    {
        if ($view == '') { $view = $this->ADT['view'] ?? '';}
        if (empty($LT)) { $LT= $this->ADT['LT'] ?? '';}
        
      $this->ADT['view'] = \lib\html\dom\Dom_s::ChangeLT($view, $LT);    
    }
}
trait Dom_HTML_ChangeLT
{
    public function ChangeLT()
    {
        
        $LT= $this->ADT['LT'] ?? '';
        foreach ($LT as $key=>$val){
            \GOB::$LT[$key]=$val;
        }

       \GOB::$html  = \lib\html\dom\Dom_s::ChangeLT(\GOB::$html,\GOB::$LT );
    }
}

/**
 * ADT kompatibilis.
 */
trait Dom_ChangeData
{

    public function ChangeData($view='', $dataT = [])
    {
        if ($view == '') { $view = $this->ADT['view'] ?? '';}
        if (empty($dataT)) { $dataT = $this->ADT['dataT'] ?? '';}
        
       $this->ADT['view'] = \lib\html\dom\Dom_s::ChangeData($view, $dataT);  
    }
}

/**
 * ADT kompatibilis.<!--:modnev|obNev|getID'-->
 */
trait Dom_ChangeModBase
{
public function setParamT($mezoT)
{
    $task=$this->ADT['task'];
    $modNev=$mezoT[0];
    $obNev=$mezoT[1] ?? ''; 
    $paramT=\GOB::$paramT[$modNev] ?? [];
    
    $paramADT=$this->ADT['paramT'][$modNev] ?? [];
    
    $paramT=array_merge ($paramT,$paramADT);
    
    $paramTSK=$this->ADT['TSK'][$task]['paramT'][$modNev] ?? [];
    $paramT=array_merge ($paramT,$paramTSK);
     
    if($obNev!='')
    {
        $paramADT1=$this->ADT['paramT'][$obNev] ?? [];
        $paramT=array_merge ($paramT,$paramADT1);
        
        $paramTSK1=$this->ADT['TSK'][$task]['paramT'][$obNev] ?? [];
        $paramT=array_merge ($paramT,$paramTSK1);
    }
    $paramT['modNev']=$mezoT[0] ; 
    if(!isset($paramT['obNev'])){$paramT['obNev']=$paramT['modNev'];}
    //if(!isset($paramT['getID'])){$paramT['getID']=$paramT['obNev'];}
    if(isset($mezoT[1])){$paramT['obNev']=$mezoT[1];}
    if(isset($mezoT[2])){$paramT['getID']=$mezoT[2];}
  
    
  return $paramT;  
    
}
 public function ChangeModBase($view='view')//ha $view nem view  akkor \GOB::$html-et cseréli
   {   
        $matches=[];$task=$this->ADT['task'];
       
        if($view=='view'){$html=$this->ADT['view'];}
        else{$html=\GOB::$html;}
       
        preg_match_all ("/<!--:([^`]*?)-->/",$html , $matches);
        $mezotomb=$matches[1];
       //  echo '--------------------------'.$mezo;
       //  print_r($matches[1]);
        if(is_array($mezotomb))
        {
            foreach($mezotomb as $mezo)
            {  
               $mezoT=explode('|', $mezo);
             //  print_r($mezoT);
               $modNev=$mezoT[0]; 
               
               $dir=strtolower(explode('_', $modNev)[0]);
              // echo $dir;
               
               $paramT=$this->setParamT($mezoT);
 //print_r($paramT);
               $paramT =\lib\base\Ob_InitMO_S::modReg($paramT) ;
 
               
               eval('$modview =\mod\\'.$dir.'\\'.$modNev.'_S::Res($paramT);');
              
               if($view=='view'){ $this->ADT['view']= str_replace('<!--:'.$mezo.'-->', $modview, $html);}
               else{\GOB::$html=str_replace('<!--:'.$mezo.'-->', $modview, \GOB::$html);}
              
            }
        }
      
    }
}
/**
A \GOB::$html-ben inicializálja a modulokat
 */
trait Dom_ChangeModHTML
{
use \lib\html\dom\trt\Dom_ChangeModBase;
    public function ChangeMod()
    {   
    $this->ChangeModBase('html');     
    } 
}
/**
$this->ADT['view']-ben inicializálja a modulokat
 */
trait Dom_ChangeModView
{
    use \lib\html\dom\trt\Dom_ChangeModBase;
    public function ChangeMod()
    {
        $this->ChangeModBase('view');
    }
}


