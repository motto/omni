<?php
namespace app\omni\mod;

class Fajtak{
 public static  $imagedir='app/omni/fajtak/';   
static public function Fajtak(){
\GOB::$html=file_get_contents('tmpl/omni/base.html',true);   

$html=<<<html
<div style="margin:20px;"><h1>Kezdőfajta választás</h1>
<h3>Ez az oldal azoknak jelenik meg akik már regisztráltak,bejelentkeztek, de még nem választottak kezdőfajtát.</h3>    
<h5>Ide kellenen egy leírás a fajtaválasztásról vásárlásról. 
    Pl.: hogy a képre kattintva megnyílik a vállasztó ablak stb..
    A képeket meg egyforma oldalárnyúra kellene csinálni,
    mert listázáskor nem jól néz ki ha, mindegyik más. Most a script átméretezi egyformára, ezért például a tacskó elég fura...</h5>    
</div>
    <!-- Default bootstrap modal example -->
<div class="modal fade"  id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div id="modaldialog" class="modal-dialog ">
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Fajta választás</h4>
      </div>
      <div  class="modal-body">
        ...
      </div>
      <div class="modal-footer">  
      
    
      </div>
    </div>
  </div>
</div>
html;


        $dirT=\lib\base\File::dirLista(self::$imagedir);
        foreach ($dirT as $dir){
          $image=\lib\base\File::lista(self::$imagedir.$dir,false)[0]  ;
         $imagedir= self::$imagedir;
         $imagepath=$imagedir.$dir;
         $title=$dir.': Rövid leírás a fajtáról';
$view=<<<view
<div style="float:left;margin:5px;" >
 <a href="index.php?app=omni&mod=Fajtavalaszt&fajta=$dir"
 data-remote="false" data-tg="tooltip" data-toggle="modal" data-target="#myModal" 
 title="$title" class="btn btn-default" style="color:grey; background-color:white;">
 <img class="ebkep" width="200" height="200"  src="$imagepath/$image"></br><h4>$dir</h4></a>
      
 </div>    
view;

$html.=$view;
        }
        
      return $html.'<div style="clear:both;" ></div> ';  
    }
}