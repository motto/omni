<?php
namespace mod\ikon;

//defined( '_MOTTO' ) or die( 'Restricted access' );
class ADT
{
    //ikon
public static $noikon='noikon.png';  //Ha nincs az adott tasknak megfeleló kép
public static $noglyph='none';       //Ha nincs az adott tasknak megfeleló glyph
public static $obNev='ikon';
/**
elérési utaknál kelhet
 */
public static $modNev='Ikon';
/**
ha tobb modul működik együtt pl.: tabla és lapozó akkor ugyanazt a get előtagot használják 
egyébként általában ugyanaz mint az obnev. a task csak simán a getElotag pl.: log=new vagy log=del
 */
public static $getID='task';
public static $size='32';
public static $label=true;
public static $glyph=true; //ha false képeket használ 
public static $trT=['lt_fromLT'];
public static $iconDir='res/ico/16/'; //kell a végére: /
public static $ikonT=[
///'eye'=>['image'=>'noikon.png','glyph'=>'eye-open'],
'none'=>['image'=>'noikon.png','glyph'=>'none'],    
'up'=>['image'=>'up.png','glyph'=>'chevron-up','bgcolor'=>'blue'],
'down'=>['image'=>'down.png','glyph'=>'chevron-down','bgcolor'=>'blue'],
'pub'=>['image'=>'published.png','glyph'=>'ok-circle','color'=>'green'],
'unpub'=>['image'=>'unpublished.png','glyph'=>'ban-circle','color'=>'red'],
'edit'=>['image'=>'edit.png','glyph'=>'edit'],
'new'=>['image'=>'plusz.png','glyph'=>'plus'],
'form'=>['image'=>'plusz.png','glyph'=>'plus'],    
'del'=>['image'=>'torol.png','glyph'=>'trash'],
'email'=>['image'=>'email.png','glyph'=>'envelope']    
//''=>['image'=>'','glyph'=>''],    
];    
public static $confirmT=['del'];

public static $LT=array('del_confirm'=>'Az ok gombra kattintva a rekord végérvényesen törlődik!',
    'new'=>'Új','edit'=>'Szerk','pub'=>'Pub','unpub'=>'Unpub','del'=>'Töröl','email'=>'Email');
/**
//jquery módosítók,html elemek paraméterei (még nem használt)
 */
public static $htmlParT=[]; 
/**
css,js és egyebek betöltése (még nem használt)
 */
public static $iniT=[];
public static $task='none';
//clikk

public static $button=True; //ha false linket generál nem nyomógombot 
/**
lehet: button,link,modal
 */
public static $type='button'; 

 
}

class Ikon
{
public $ADT=[];
public function __construct($parT=[])
{
$this->ADT = get_class_vars('\mod\ikon\ADT');
$this->ADT=array_merge ($this->ADT,$parT);
}
public function glyphIcon()
{   $task=$this->ADT['task'] ;
    $class=$this->ADT['class'] ?? '';
    $sizeB=$this->ADT['size'] ?? '16';
    $size=ceil($sizeB/2);
    
    $noglyph=$this->ADT['noglyph'] ?? 'no';
    $glyph=$this->ADT['ikonT'][$task]['glyph'] ?? $noglyph;
    $color=$this->ADT['ikonT'][$task]['color'] ?? '';
    if($color!=''){$colorstyle='color:'.$color.';';}else{$colorstyle='';}
    $bgcolor=$this->ADT['ikonT'][$task]['bgcolor'] ?? '';
    if($bgcolor!=''){$bgcolorstyle=' background-color:'.$bgcolor.';';}else{$bgcolorstyle='';}
    return '<span  style="font-size: '.$size.'px;'.$colorstyle.$bgcolorstyle.' margin-bottom:10px;"
        		class="moikon '.$class.' glyphicon glyphicon-'.$glyph.'"></span>';
}
public function imageIcon()
{
    $task=$this->ADT['task'];
    $class=$this->ADT['class'] ?? '';
    $noimage=$this->ADT['noikon'] ?? 'noimage.png';
    $img=$this->ADT['ikonT'][$task]['image'] ?? $noimage;

    return '<img class="moikon '.$class.'"
            src="'.$this->ADT['iconDir'].$img.'"/>';
}

public function Ikon()
{
    
    if($this->ADT['glyph']){$icon=$this->glyphIcon();}
    else{$icon=$this->imageIcon();}
    return $icon;

}

}    

class Ikon_Clikk extends Ikon
{
    public function ikonVarT()
    {
        $task=$this->ADT['task'];
        $link=$this->ADT['link'] ?? '';
        if($link==''){ $link=\lib\base\LINK::GETcsereT([$this->ADT['getID']=>$task]); }
         
        $icon=$this->Ikon();
        
        if($this->ADT['label'])
        {$label=$this->ADT['LT'][$task] ?? $task;  $label='</br>'.$label;}
        else{$label='';}
        
        if(in_array($task,$this->ADT['confirmT'])){ $oncl='onclick="return confirmSubmit(\''.$this->ADT['LT'][$task.'_confirm'].'\')"';}
        else{$oncl='';} 
        
          $res['link']=$link;  
          $res['oncl']=$oncl;  
          $res['label']=$label;
          $res['icon']=$icon;
          
          return $res;
      
    }
    public function buttonIkon()
    {
        
        $varT=$this->ikonVarT();
        $res='<button class="btkep" type="submit" name="'.$this->ADT['getID'].'"
        value="'.$this->ADT['task'].'" '.$varT['oncl'].'>'.$varT['icon'].$varT['label'].'</button>';
    
        return $res;
    }
    public function linkIkon()
    {
        $varT=$this->ikonVarT();
        $res='<a class="btkep" href="'.$varT['link'].'"  '.$varT['oncl'].'>'.$varT['icon'].$varT['label'].'</a>';
    
        return $res;
    }
    public function modalIkon()
    {
        $varT=$this->ikonVarT();
        $res ='<a class="btkep" href="'.$varT['link'].'" data-remote="false"
               data-tg="tooltip" data-toggle="modal" data-target="#myModal"
               title="title" >'.$varT['icon'].$varT['label'].'</a>';
    
    
        return $res;
    }
    
    public function Clikk()
    {
        switch ($this->ADT['type'] )
        {
            case 'modal':
             $icon=$this->modalIkon(); 
                break;
            case 'link':
             $icon=$this->linkIkon();
                break;
            default:  //'button'
              $icon=$this->buttonIkon();
        }

       return $icon;
    }    
    
}

class Ikon_S
{
    public  static function Res($parT=[])
    {   
        $ob=new Ikon($parT);
        return $ob->ikon();
    
    }
    
}

class Ikon_Clikk_S
{ 
    public  static function Res($parT=[])
    {
        
        $ob=new Ikon_Clikk($parT);
        return $ob->Clikk();
    
    }
}
class Ikon_ClikkSor_S
{
    public  static function Res($paramT=[]){
      // $parT['ikonsorT']=['new','edit','unpub'];
        $ikonsorT=$paramT['ikonsorT'];
        unset($paramT['ikonsorT']);
        $res='<div style="float:right;margin:20px;">';
        foreach ($ikonsorT as $task) {
            if(is_array($task))
            {$paramT=array_merge ($paramT,$task);}
            else
            {$paramT['task']=$task;}
           
            $ob=new Ikon_Clikk($paramT);
            $res.= $ob->Clikk();
        }
        $res.='</div><div style="clear:both;"></div>';
        return $res;
        
        
    
    }
}


