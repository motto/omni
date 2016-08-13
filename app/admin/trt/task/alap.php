<?php
namespace app\admin\trt\task;
defined( '_MOTTO' ) or die( 'Restricted access' );

trait Alap{
    
use \app\admin\trt\task\View; 
    
public function Alap()
{ 

    $task=$this->ADT['task'];

    $rendezmezo=$_GET['tab_rendez'] ?? '';
    $order=$_GET['tab_order'] ?? 'ASC';
    if($rendezmezo!=''){$rendez=" ORDER BY $rendezmezo $order";}else{$rendez='';}
    $limitstart=$_GET['tab_start'] ?? '0';
    $limit=$this->ADT['paramT']['Pagin']['limit'] ?? '50';
    $limitSTR=" LIMIT $limitstart,$limit";
    
   // $sql="SELECT * FROM ".$this->ADT['tablanev'].$rendez.$limitSTR;
   $sql=$this->ADT['TSK'][$task]['sql'].$rendez.$limitSTR;
    $dataT=\lib\db\DB::assoc_tomb_Count($sql);
    $this->ADT['paramT']['Tabla']['dataT']=$dataT['dataT'];
    $this->ADT['paramT']['Pagin']['recordSum']=$dataT['sum'];
    
    $this->View();

}}