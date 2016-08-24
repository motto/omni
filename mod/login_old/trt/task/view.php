<?php
namespace mod\login\trt\task;
defined( '_MOTTO' ) or die( 'Restricted access' );
trait View
{
    public function Res()
    {	
    $task=$this->ADT['task'];
    $appdir=$this->ADT['appDir'] ?? 'mod/login';
    $view=$this->ADT['TSK'][$task]['view'];
    
	//ha érvényes az aktuális templétben a $dir path akkor az lesz a $dir
	if(is_file('tmpl/'.\GOB::$tmpl.'/'.$appdir.'/view/'.$view))
	{$dir='tmpl/'.\GOB::$tmpl.'/'.$appdir.'/view';}
	else{$dir=$appdir.'/view';}
	//ha vannak init fileok becsatolja őket
	if(is_file($dir.'/init.php')){include $dir.'/init.php';}
	if(is_file($dir.'/'.$task.'_init.php')){include $dir.'/'.$task.'_init.php';}
	
	//view file tartalmának beolvasása ha van érvényes view file.
	//kell az ellenőrzés!!!
	if(is_file($dir.'/'.$view))
	{
	$view= file_get_contents( $dir.'/'.$view,true);
	}
	$this->ADT['view']=$view;
	//$this->ADT['TSK'][$task]['next']='feltolt';
    }
    

}	