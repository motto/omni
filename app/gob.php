<?php

namespace app;
defined( '_MOTTO' ) or die( 'Restricted access' );

class  Gob_RES{
	public static $dataT=[];
	public static $idT=[];
	public static $viewT=[];	
	
	
}
class  Gob_PAR{
	/**
	 nyelvi tömb. Ha nem adatbázist használ az app ebből tölti fel ADT::$dataT['lang']-ot
	 */
	static public $LT=[];
	
	/**
	 az app láthatósági jogosultsága
	 */
	static public $jog='noname';
	/**
	 a task megállapítás ebben a sorrendben történik. Az utolsó marad
	 */
	static public $taskOrder=['SESSION','POST','GET'];

	/**
	 a szükséges modulok paraméterei
	 */
	static public $modT=[];
	static public $dataszerkT=[];


}
class  Gob_ADT{

}