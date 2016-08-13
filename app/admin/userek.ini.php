<?php
namespace app;
defined( '_MOTTO' ) or die( 'Restricted access' );
//echo 'userek';
/**
 ha sima use-val használjuk a traiteket nem tudunk beépíteni változókat pl:CONF::$LangMode
 azért kell associativ tömb hogy felül  írható legyen!
 */
//$loginTRT['SetLT']='\lib\lang\trt\\'.\CONF::$LangMode.'\\'.\CONF::$LangForras.'\Set_SetLT';
$TRT['SetLT']='\lib\lang\trt\single\tomb\Set_SetLT';
$TRT['GetTask']='\lib\task\trt\Task_PG_GetTask';
//$TRT['GetJog']='\lib\task\trt\Task_PG_GetTask';
$TRT['Task']='\lib\task\trt\Task';
$TRT['ChangeLT']='\lib\html\dom\trt\ Dom_HTML_ChangeLT';
$TRT['ChangeData']='\lib\html\dom\trt\Dom_ChangeData';
$TRT['ChangeMod']='\lib\html\dom\trt\Dom_ChangeModHTML';
/**
az alaptask tábla szerkezete lehet több is a TSK osztály mgfelelő taskjához kellbeszúrni
 */


class ADT{

    //fontos--------------------------
    public static $jog='admin';
    public static $html='admin.html';
    public static $task='alap';
    public static $idT=[];
    public static $tablanev='userek';
    /**
     a task trait-nek ha nins a tasknak megfelelő funkciója ilyennel kell rendelkezni (felülírható)
     */
    public static $resfunc='Alap';
    public static $view='';
    public static $dataT=[];
    /**
     ellenőrzott POST adatok (safePost). Ide kell írni (ellenőrzés után !)
     minden adatot, amit adatbázisba akarunk menteni
     */
    public static $SPT=[];
    /**
     ide kell a nyelvi elemeket beírni
     */
    public static $LT=[];
    public static $paramT=[];

} 

class TSK{
    static public $alap=[
       // 'paramT'=>['Ikon_ClikkSor'=>['ikonsorT'=>['del','pub']]],
        'resfunc'=>'Alap',
        'sql'=>'SELECT * FROM userek',
        'trt'=>['app\admin\trt\task\Alap'],
        'view'=>'admintabla.html'
    ];
    static public $pub=['trt'=>['app\admin\trt\task\Pub'],'next'=>'alap'];
    static public $unpub=['trt'=>['app\admin\trt\task\Pub'],'resfunc'=>'unpub','next'=>'alap'];
    static public $del=['trt'=>['app\admin\trt\task\Del'],'next'=>'alap'];
   // static public $joghiba=['trt'=>['app\admin\trt\task\Joghiba']];
    static public $email=['trt'=>['app\admin\trt\task\View','app\admin\EvalFunc'],'view'=>'email_form.html',
        'resfunc'=>'View','before'=>'evalfunc',
        'evalSTR'=>'$_SESSION[\'idT\']=$_POST[\'idT\']; $this->ADT[\'dataT\'][\'fromnev\']=\CONF::$fromnev;
        $this->ADT[\'dataT\'][\'setfrom\']=\CONF::$mailfrom;'
        
    ];
    static public $mailkuld=['trt'=>['app\admin\trt\task\Mailkuld'],'next'=>'alap','resfunc'=>'Mailkuld'];
  //  static public $uj=['trt'=>'mod\login\trt\task\Save','resfunc'=>'Save_passwd',];
   // static public $szerk=['trt'=>['mod\login\trt\task\Kilep'],'next'=>'alap'];
  /*  static public $save=
    [
        'resfunc'=>'Save_Reg',
        'trt'=>['mod\login\trt\task\Save_Reg'],
        'next'=>'alap',
        'ell'=>[]
    ];*/

}
//
ADT::$paramT['Ikon_ClikkSor']['ikonsorT']=['del','pub','unpub','email'];
ADT::$paramT['Ikon_ClikkSor']['getID']='task';
ADT::$paramT['Tabla']['dataszerkT']=['chk'=>['nocim'=>true,'func'=>'checkbox_mezo'],'pub'=>['nocim'=>true,'func'=>'pub_mezo'],'username'=>[],'email'=>[]];
ADT::$paramT['Pagin']['limit']='10';
\GOB::$tmpl='admin';
ADT::$LT['lapcim']='Felhasználó admin';
//TSK::$alap['paramT']['Ikon_ClikkSor']=['ikonsorT'=>['new','edit','del','pub','unpub','email']];
///TSK::$alap['paramT']['Tabla']['dataszerkT']=['chk'=>['nocim'=>true,'func'=>'checkbox_mezo'],'id'=>['nocim'=>true,'func'=>'pub_mezo']
//,'username'=>[],'email'=>[]];
