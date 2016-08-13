<?php
namespace app\admin\trt\task;
defined( '_MOTTO' ) or die( 'Restricted access' );

trait Joghiba{ public function Res(){
  
    if($_SESSION['userid']==0)
    {$this->ADT['view']=\mod\login\Login_S::Res(); }
    else 
    {
        \GOB::$LT['joghiba'] ?? 'Jogosultság hiba';
        $this->ADT['view']='<h3>'.$this->ADT['view'].'<h3>';
    }
     
}}