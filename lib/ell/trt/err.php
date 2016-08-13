<?php
namespace lib\ell\trt;
defined( '_MOTTO' ) or die( 'Restricted access' );

trait Err{
    public function hibakiir()
	{
		$result='';
	
		{ $hibaT = array_unique($this->ADT['hibaT']);
		foreach($hibaT as $hiba)
		{
			$result.='<h4>'.$hiba.'</h4>';
		}
		}
		return $result;
	}
    
}