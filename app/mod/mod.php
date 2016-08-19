<?php 
namespace app\mod;

defined( '_MOTTO' ) or die( 'Restricted access' );
  
  \GOB::$html=file_get_contents('tmpl/'.\GOB::$tmpl.'/base.html',true);
  
// evaL('$view=\mod\\'.$_GET['mod'].'\\' .ucfirst($_GET['mod']).'_S::Res();') ;
$view=\mod\media\Media_S::Res();
  \GOB::$html= str_replace('<!--|content|-->',$view ,\GOB::$html);