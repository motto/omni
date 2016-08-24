<?php
class Handy{
	public function hibakiir($ADT)
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
	
	public static function safePOST($val,$res='')
	{
		if(isset($_POST[$val])){$res=$_POST[$val];}
		return $res;
	}
}