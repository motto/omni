<?php
namespace lib\ell\trt;

defined( '_MOTTO' ) or die( 'Restricted access' );

trait Regx{

public function regex_cserel($text,$parT=[]){

	foreach ($parT as $nev=>$val){
		$text= str_replace('<<'.$nev.'>>', $val, $text);
	}
	return $text;
}
public function regx($parT=[]){
	$res=[];$res['bool']=true;$changeT=[];
	$regx=$parT[0];
	
	if(isset(\lib\ell\Ell_STR::$regexT[$regx]))
	{$regx=\lib\ell\Ell_STR::$regexT[$regx];}
	
	if(isset($parT[1]) && !empty($parT[1])){$err=$parT[1];}else{$err='regexhiba';}
	if(isset($parT[2])){
		$regx=$this->regex_cserel($regx,$parT[2]);
		$changeT =$parT[2];
	}
	//echo'--'.$regx;
	if (!preg_match($regx,$this->val))
	{$res['bool'] = false; $res['err']=[$err,$changeT]; }
	
return $res;
	
}}
