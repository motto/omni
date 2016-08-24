<?php
namespace mod\tabla;

use lib\base\LINK;
defined( '_MOTTO' ) or die( 'Restricted access' );

class ADT{
    
/**
egyben a tasknév is ha az uniq=true a constructor ellnőrzi  GOB::modT-ben és sorszámozza
 */
static public  $obNev='tab';
static public  $jog='noname';
/**
 elérési utaknál kelhet
 */
public static $modNev='Tabla';
/**
 ha tobb modul működik együtt pl.: tabla és lapozó akkor ugyanazt a get előtagot használják
 egyébként általában ugyanaz mint az obnev. a task csak simán a getElotag pl.: log=new vagy log=del
 */
public static $getID='tab';
public static $uniq=false;
static public  $glyph=True; //ha false képeket használ    
static public  $rendez_sor=true;    
static public  $fejlec=true;
static public  $checkbox=true;
static public  $pubikon=true;
static public  $dataT=[];
/**
lehet több egyforma index is! a cimet határozza meg, nem a mezőnevet!!!
 ha a mezőnév nem azonos az indexel külön 'mezo' paraméter kell 
 */
static public  $dataszerkT=[];
/**
 Ha egy rekordban azon a kulcso szerepel az az érték, akkor a rekord nem jelenik meg
 PL ['name'=>['motto','Admin'],'id'=>['11']] (a felhasználók a mottto és az admin névvel  és a 11-es iddel nem jelennek meg  )
 */
static public  $norekordT=[];
static public  $cssFile='';//elérési utat kell megadni ha sját css-akarunk
static public  $css='';
//public static $trT=['lt_fromLT'];
public static $iconDir='res/ico/16';
public static $LT=['up'=>'Fel','down'=>'Le','pub'=>'Pub','unpub'=>'Unpub','del'=>'Töröl'];
public static $paramT=['ikon'=>[
 'imagesize'=>'38',  
 //'glyph'=>true,
'ikonT'=>[
'up'=>['image'=>'up.png','glyph'=>'chevron-up','bgcolor'=>'blue'],
'down'=>['image'=>'down.png','glyph'=>'chevron-down','bgcolor'=>'blue'],  
'pub'=>['image'=>'published.png','glyph'=>'ok','color'=>''],     
'unpub'=>['image'=>'unpublished.png','glyph'=>'remove','color'=>''],    
'eye'=>['image'=>'eye.png','glyph'=>'eye-open','color'=>'red']      
]]];
}

class Tabla 
{
use \mod\ikon\trt\Ikon_TR;
use \mod\ikon\trt\Ikon_Clikk_TR;
use \lib\base\trt\Ob_InitMO;
public $ADT=[];

    public function __construct($parT=[])
    {
     
        $this->InitMO($parT,'\mod\tabla\ADT');
      
    }

   public function checkbox_mezo($mezo,$rekord=[])
    {
        return '<input type="checkbox" class="tabcheck" name="idT[]" value="'.$rekord['id'].'" />';
    }
    /**
 $valpar=link példa:index.php?app=mod&mod=eye&tab=email&id=\'.$rekord["id"].\'&key=mailid'
     */
    public function eyeLink($mezo,$rekord=[],$evalpar=[])
    {

       eval('$link=\''.$evalpar.'\';');
        return      $res='<a href="'.$link.'" data-remote="false"
               data-tg="tooltip" data-toggle="modal" data-target="#myModal"
               title="title" >'.$this->Ikon(['task'=>'eye','label'=>false]).'</a>';
    }
 
    public function listaLink($mezo,$rekord=[],$evalpar=[])
    {
        $res=$rekord[$mezo];
        if($rekord[$mezo]=='lista'){
            
           $res=$this->eyeLink($mezo,$rekord,$evalpar).' Lista';
        }
    return $res;
    }
    public function pub_mezo($mezo,$rekord=[],$evalpar=[])
    {
        
        if($rekord[$mezo]=='0'){return $this->Ikon(['task'=>'pub','label'=>false]);}
        else{return $this->Ikon(['task'=>'unpub','label'=>false]);}
    }
    
    public   function orderikon($mezonev){
        
        $csereTup=[$this->ADT['getID'].'_rendez'=>$mezonev,$this->ADT['getID'].'_order'=>'DESC'];
        $linkup =\lib\base\LINK::GETcsereT($csereTup);
    
        $csereTdown=[$this->ADT['getID'].'_rendez'=>$mezonev,$this->ADT['getID'].'_order'=>'ASC'];
        $linkdown =\lib\base\LINK::GETcsereT($csereTdown);
        
        $iconUp=$this->Ikon_Clikk(['task'=>'up','link'=>$linkup,'type'=>'link','label'=>false]);
        $iconDown=$this->Ikon_Clikk(['task'=>'down','link'=>$linkdown,'type'=>'link','label'=>false]);
        $html=$iconUp.$iconDown;
        return $html;
    }

    public function mezo($data="")
    {
        $html="<td>". $data."</td>";
        return $html;
    }
/**
lehet több egyforma index is! a cimet határozza meg, nem a mezőnevet.
 ha a mezőnév nem azonos az indexel külön 'mezo' paraméter kell 
 */
    public function sor($datasor)
    {
        $html='<tr>';
      //  if($this->ADT['checkbox']){$html.='<td></td>';}
      //  if($this->ADT['pubikon']){$html.='<td></td>';}
        
        foreach($this->ADT['dataszerkT'] as $cim=> $mezotomb)
        {
             
            $key=$mezotomb['mezo'] ?? $cim;
            $data=$datasor[$key] ?? ' ';
            
			if(isset($mezotomb['func'])) 
			{
			   $evalpar=$mezotomb['funcEvalparam'] ?? [];
			    	       
			        $func=$mezotomb['func'];
			        $data=$this->$func($key,$datasor,$evalpar);   
			}
            else{
              $data=substr($data, 0,30);
            }    
            $html.=$this->mezo($data);
        }
        $html.='</tr>';
        return $html;
    }
    public function fejlec()
    { 
        $css=<<<css
<style>        
     table {

        padding: 25px;
        background-color:whitesmoke;
        margin-left:5%;
        margin-top:3%;
        min-width:70% ;

        color: darkslategray;
    }
    .trfejlec{
        background-color: royalblue;
        color: white; 
    }
    th {
        height: 50px;
    }
    table, th, td { padding: 5px;
        border: 1px solid black;max-width:30%;
    }     
</style>        
css;
        $html=$css;
        $html.='<tr class="trfejlec">';
       // $html='<tr class="trfejlec" >';
       // if($this->ADT['checkbox']){$html.='<td></td>';}
       // if($this->ADT['pubikon']){$html.='<td></td>';}
        foreach($this->ADT['dataszerkT']  as $mezonev => $mezotomb)
        { 
           $onclick='';
           if(isset($mezotomb['nocim'])){ $mezocim=' ';}
           else{
           $mezocim=$mezotomb['cim'] ?? $mezonev;
           $mezocim=$this->ADT['LT'][$mezonev] ?? $mezocim;
           if(!isset($mezotomb['noorder'])){ $mezonev.=' '.$this->orderikon($mezonev);}  
           //if(!isset($mezotomb['noorder'])){ $onclick='onclick="tab_order(\''.$mezonev.'\')" ';}
           }
           //$tr='<button class="btn btn-primary" '.$onclick.' >'.$mezocim.'</button>'; 
           //$html.=$this->mezo($tr);
           $html.=$this->mezo($mezocim);
           
        }
        $html.="</tr>";
        return $html;
    }

    public function Res()
    { 
        if(empty($this->ADT['dataT']))
         {$html='<h3>A táblázat nem tartalmaz adatokat!<h3>';}
         else
         {
            $html='<table>';
            $html.=$this->fejlec();
           // $html.=$this->rendez_sor();
            foreach($this->ADT['dataT'] as $datasor)
            {
                 $html.=$this->sor($datasor);
    
            }
            $html.='</table>';   
        }
       
        return $html;
    }
}

class Tabla_S
{
    public static function Res($parT=[]){
         
        $ob=new Tabla($parT);
        return $ob->Res();
    }  
}
