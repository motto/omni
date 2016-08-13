<?php
namespace app\omni\mod;

class Fajtavalaszt{
public static  $imagedir='app/omni/fajtak/';
     
static public function Fajtavalaszt(){
  \GOB::$html=file_get_contents('tmpl/omni/simple.html',true);
  $fajta=$_GET['fajta'];        
  $imagepath =  self::$imagedir.$fajta;   
  //$subdir='omni';
  $kepT=\lib\base\File::lista($imagepath,false);
  $kepek='';
  $info='Rövid info a fajtaváltozatról' ;
  $confirm='Az ok gombra kattintva a fajta és színváltozat választása megtörténik.Később még módosítható!';
foreach ($kepT as $kep){
  $valtozat=  pathinfo($kep, PATHINFO_FILENAME);
$view=<<<view

<div style="float:left;margin:5px;" >
 <a href="index.php?app=omni&fajta=$fajta&valtozat=$valtozat" 
 onclick="return confirm('$confirm');"
 title="$info" class="btn btn-default" style="color:grey; background-color:white;">
 <img class="ebkep" width="200" height="200"  src="$imagepath/$kep"></br><h4>$valtozat</h4></a>
      
 </div> 

view;

            $kepek.=$view;
        }
  
$html=<<<html

 $kepek 
 <div style="clear:both;" ></div> 
<h3>Bővebb info a fajtáról és változatairól:</h3> 

 <!--  <button type="button" onclick="window.location='index.php?app=omni&valaszt=$fajta';"class="btn btn-primary">Ezt váasztom</button>
   <button type="button" class="btn btn-default" data-dismiss="modal">Mégsem</button> -->  
  </br> </br>   
gh ghh fgjjsrzuoa bheatz io noie6r8o698op7 5r9 gfhgsahd
     gh ghh fgjjsrzuoa bheatz io noie6r8o698op7 5r9 gfhgsahdgh ghh fgjjsrzuoa bheatz io noie6r8o698op7 5r9 gfhgsahd
     gh ghh fgjjsrzuoa bheatz io noie6r8o698op7 5r9 gfhgsahdgh ghh fgjjsrzuoa bheatz io noie6r8o698op7 5r9 gfhgsahd
     gh ghh fgjjsrzuoa bheatz io noie6r8o698op7 5r9 gfhgsahdgh ghh fgjjsrzuoa bheatz io noie6r8o698op7 5r9 gfhgsahd
     gh ghh fgjjsrzuoa bheatz io noie6r8o698op7 5r9 gfhgsahd
html;


     
//echo $html;
        return $html;

    }
}