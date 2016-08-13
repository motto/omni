<?php
namespace lib\db\trt;
use lib\db\DB;

defined( '_MOTTO' ) or die( 'Restricted access' );
trait DB_marvan{ public function marvan($value,$sql,$err)
{
//$clnev=__CLASS__;	
if($value==DB::egymezo($sql)){$this->ADT['hibaT'][]=$err;}
}}
trait DB_match{ public function match($value,$sql,$err)
{
	
}}