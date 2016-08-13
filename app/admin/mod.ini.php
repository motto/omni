<?php
namespace app;
defined( '_MOTTO' ) or die( 'Restricted access' );

class ADT{

    //fontos--------------------------
    public static $jog='admin';
    public static $html='modal.html';
  //  public static $task='alap';
  //  public static $resfunc='Alap';
    public static $view='';
}


$mod=$_GET['mod'] ?? '';
$file=strtolower(explode('_', $mod)[0]);
if(is_file('app/admin/mod/'.$file.'.php'))
{
    \GOB::$tmpl='admin';
   eval('\app\ADT::$view=app\admin\mod\\'.ucfirst($mod).'_S::Res();');  
}
else if(is_file('app/mod/'.$file.'.php'))
{
    eval('\app\ADT::$view=app\mod\\'.ucfirst($mod).'_S::Res();');  
}
else 
{
 eval('\app\ADT::$view=\mod\\'.ucfirst($mod).'\\'.ucfirst($mod).'_S::Res();');    
}
    

