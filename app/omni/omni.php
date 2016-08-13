<?php
use lib\base\Base;
use lib\db\DB;
use lib\db\DBA;
//use mod\login\Login_S;

\GOB::$html=file_get_contents('tmpl/omni/base.html',true);  

if($_SESSION['userid']==0){
 
    $content=file_get_contents('tmpl/omni/mod/nyito.html',true);  
}
else
{  
if(isset($_GET['fajta']) && isset($_GET['valtozat'])){
    $sql="SELECT fajta,var FROM kenel WHERE userid='".$_SESSION['userid']."'";
    $userT= DB::assoc_sor($sql);
    if(empty( $userT)){
    $sql2="INSERT INTO kenel (userid,fajta,var) VALUES ('".$_SESSION['userid']."','".$_GET['fajta']."','".$_GET['valtozat']."')";
    DBA::parancs($sql2);
	$url =\lib\base\LINK::GETtorolT(['fajta','valtozat']);
     header("Location: $url"); /* ujratölt */
		exit();
    }       
}

 $mod=$_GET['mod'] ?? 'Alap';  
   $sql="SELECT fajta,var FROM kenel WHERE userid='".$_SESSION['userid']."'";
   $userT= DB::assoc_sor($sql);
    if(empty($userT) && $mod!='Fajtavalaszt'){
        
      $content=app\omni\mod\Fajtak::Fajtak();       
    }
    else{
   \GOB::$userT['fajta']=$userT['fajta'] ?? '';
   \GOB::$userT['var']=$userT['var'] ?? ''; 
   
    eval('$content=\app\omni\mod\\'.$mod.'::'.$mod.'();') ; 
    //echo $content;
    }

   
} 

$login= \mod\login\Login_S::Res(); 
//$content=\app\omni\mod\Fajtak::csoportListaz();
GOB::$html= str_replace('<!--|login|-->',$login ,GOB::$html);
GOB::$html= str_replace('<!--|content|-->',$content ,GOB::$html);







