<?php
session_start();
define("DS", "/"); define("_MOTTO", "igen");

use lib\db ;
use lib\jog\Azonosit;
use lib\base\Base;
//use lib\html\Fejlec_s;
//use  lib\base ;

include 'def.php';
if(CONF::$offline && !GOB::get_userjog('admin'))
{die(CONF::$offline_message);}

//GOB::$db-be létrehozza az adatbázis objektumot
db\Connect::connect();

//azonosítás-------------
if(isset($_POST['ltask']) && $_POST['ltask']=='kilep'){ $_SESSION['userid'] = 0;}
$azon= new \lib\jog\Azonosit();
GOB::$userT=$azon::set_userdata($_SESSION['userid']);
GOB::set_userjog();

//nyelv-------------------
GOB::$lang=Base::setLang(CONF::$baseLang);

//template-----------------------------
GOB::$tmpl=$_GET['tmpl'] ?? CONF::$baseTmpl;

//applikáció becsatolás-----------------------------
GOB::$app=$_GET['app'] ?? CONF::$baseApp;

if(is_file('app/'.GOB::$app.'/'.GOB::$app.'.php'))
{include 'app/'.GOB::$app.'/'.GOB::$app.'.php';}
else
{include 'app/app.php';}

//érvényes parT kulcsok:['head','bodyhead','bodyfoot']
$htmlParT=\GOB::$paramT['html'] ?? [];
lib\html\Fejlec_s::ChangeFull($htmlParT);


echo GOB::$html;
