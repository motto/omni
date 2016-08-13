<?php
namespace app;

defined( '_MOTTO' ) or die( 'Restricted access' );

\GOB::$tmpl='admin';
$iniF=$_GET['iniF'] ?? 'userek';
if(is_file('app/admin/'.$iniF.'/'.$iniF.'.ini.php'))
{include 'app/admin/'.$iniF.'/'.$iniF.'.ini.php';}
else
{
    include 'app/admin/'.$iniF.'.ini.php';
}