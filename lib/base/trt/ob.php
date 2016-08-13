<?php
namespace lib\base\trt;
defined( '_MOTTO' ) or die( 'Restricted access' );
/**
 A \lib\base\Ob_InitMO_S::Res-el egyesíti parT-t az $ADTclass-al (stringel kell megadni,pl.:'\mod\tabla\ADT' )
 és a \lib\base\Ob_InitMO_S::modReg-el beállítja a modNev-et és a getID-et,
 valamint a \GOB::$modT-ben regisztrállja a modult (az Ob_InitMO_S::Res hívja meg)
 */
trait Ob_InitMO
{  
    public function InitMO($parT,$ADTclass='') 
    {  
      $this->ADT =\lib\base\Ob_InitMO_S::Res($parT,$ADTclass) ;

}}