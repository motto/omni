<?php
use lib\db\DBA;

//use mod\mail\Mail_S;

//session_start();
define("DS", "/"); define("_MOTTO", "igen");
//use  lib\db ;

include 'def.php';
//db\Connect::connect();//GOB::$db-be létrehozza az adatbázis objektumot

//include 'test/mod/login/t_login.php';

class GOBT{
    use mod\login\trt\Email;
	static public  $resT;
}

$parT['cim']='menkuotto@gmail.com';$parT['Subject']='hhhhhhhhh';$parT['Body']='uzb uiz buizui';
echo \mod\email\Email_S::Res($parT)['err'];
//echo mod\ikon\Ikon_S::Ikon('del');
//echo lib\db\DB::Count("SELECT * FROM userek");
//$_SERVER['REQUEST_URI']='index.php';
//echo mod\pagin\Pagin_S::Pagin(['tabnev'=>'ujtab']);

//$ff=new GOBT();
//$ff->Email();
//mod\email\Email_S::regConfirm('menkuotto@gmail.com','152');
//include 'test/lib/str/t_str.php';
//include 'test/lib/base/t_task.php';
//include 'test/lib/base/t_link.php';
//include 'test/lib/base/t_ob.php';
//include 'test/lib/ell/t_ell.php';
//include 'test/lib/base/t_base.php';
//probák  nem tesztek!!!!!!!---------------------------------
//include 'test/lib/html/t_html.php';
//include_once 'test/lib/html/t_dom.php';
//include 'test/lib/base/p_file.php';
//include 'test/lib/itemview/p_itemview.php'; 
if(empty(GOBT::$resT)){echo "\n a tesztek sikeresen lefutottak!";}else{
echo"\n A kovetkező tesztek nem futottak le sikeresen: ";
foreach(GOBT::$resT as $clas=>$func){ echo "\n class:".$clas." func: ";}	
foreach($func as $funcnev=>$val){ echo $funcnev.",".$val."; ";}

}
echo 'Futás idő:'.(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']).'microsec';
//ObMo_St::res();