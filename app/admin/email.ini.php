<?php
namespace app;
defined( '_MOTTO' ) or die( 'Restricted access' );

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
        'sql'=>'SELECT * FROM email',
        'trt'=>['app\admin\trt\task\Alap'],
        'view'=>'admintabla.html'
    ];

}
//


ADT::$paramT['Ikon_ClikkSor']['getID']='task';
ADT::$paramT['Ikon_ClikkSor']['ikonsorT']=[];
ADT::$paramT['Tabla']['dataszerkT']=['id'=>['nocim'=>true,'func'=>'eyeLink','funcEvalparam'=>'index.php?app=admin&iniF=mod&mod=tab_emailcim&emailid=\'.$rekord["id"].\'&key=mailid'],'cim'=>['func'=>'listaLink','funcEvalparam'=>'index.php?app=admin&iniF=mod&mod=tab_emailcim&emailid=\'.$rekord["id"].\''],'subject'=>[],'res'=>[],'datum'=>[]];
ADT::$paramT['Pagin']['limit']='10';
\GOB::$tmpl='admin';
ADT::$LT['lapcim']='Elküldött levelek';