<?php
namespace app\mod;
defined( '_MOTTO' ) or die( 'Restricted access' );

//$loginTRT['SetLT']='\lib\lang\trt\\'.\CONF::$LangMode.'\\'.\CONF::$LangForras.'\Set_SetLT';
$TRT['SetLT']='\lib\lang\trt\single\tomb\Set_SetLT';
$TRT['GetTask']='\lib\task\trt\Task_PG_GetTask';
//$TRT['GetJog']='\lib\task\trt\Task_PG_GetTask';
$TRT['Task']='\lib\task\trt\Task_app';
$TRT['ChangeLT']='\lib\html\dom\trt\ Dom_HTML_ChangeLT';
$TRT['ChangeData']='\lib\html\dom\trt\Dom_ChangeData';
$TRT['ChangeMod']='\lib\html\dom\trt\Dom_ChangeModHTML';

class ADT{

    //fontos--------------------------
    public static $jog='admin';
    public static $html='simple.html';
    public static $task='alap';
    public static $idT=[];
   // public static $tablanev='userek';
    /**
     a task trait-nek ha nins a tasknak megfelelő funkciója ilyennel kell rendelkezni (felülírható)
     */
    public static $resfunc='Res';
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
      //  'sql'=>'SELECT * FROM email',
        'trt'=>['app\mod\Alap'],
        'view'=>'admintabla.html'
    ];

}
trait Alap{
    
    public function Alap()
    {
        
    }
}


ADT::$paramT['Ikon_ClikkSor']['getID']='task';
ADT::$paramT['Ikon_ClikkSor']['ikonsorT']=[];
ADT::$paramT['Tabla']['dataszerkT']=['id'=>['nocim'=>true,'func'=>'eyeLink','funcEvalparam'=>'index.php?app=mod&mod=eye&tab=email&id=\'.$rekord["id"].\'&key=mailid'],'cim'=>['func'=>'listaLink','funcEvalparam'=>'index.php?app=mod&mod=eye&tab=eposted&id=\'.$rekord["id"].\''],'subject'=>[],'res'=>[],'datum'=>[]];
ADT::$paramT['Pagin']['limit']='10';

ADT::$LT['lapcim']='Elküldött levelek';