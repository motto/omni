<?php
namespace app;
defined( '_MOTTO' ) or die( 'Restricted access' );
//echo 'userek';

//$loginTRT['SetLT']='\lib\lang\trt\\'.\CONF::$LangMode.'\\'.\CONF::$LangForras.'\Set_SetLT';
$TRT['SetLT']='\lib\lang\trt\single\tomb\Set_SetLT';
$TRT['GetTask']='\lib\task\trt\Task_PG_GetTask';
//$TRT['GetJog']='\lib\task\trt\Task_PG_GetTask';
$TRT['Task']='\lib\task\trt\Task';
$TRT['ChangeLT']='\lib\html\dom\trt\ Dom_HTML_ChangeLT';
$TRT['ChangeData']='\lib\html\dom\trt\Dom_ChangeData';
$TRT['ChangeMod']='\lib\html\dom\trt\Dom_ChangeModHTML';

class ADT{

    //fontos--------------------------
    public static $jog='admin';
    public static $html='admin.html';
    public static $task='alap';
    public static $idT=[];
    public static $tablanev='fajta';
    /**
     a task trait-nek ha nins a tasknak megfelelő funkciója ilyennel kell rendelkezni (felülírható)
     */
    public static $resfunc='Alap';
    public static $view='';
    public static $dataT=[];
    public static $SPT=[];
    public static $LT=[];
    public static $paramT=[];

} 

class TSK{
    static public $alap=[
       // 'paramT'=>['Ikon_ClikkSor'=>['ikonsorT'=>['del','pub']]],
        'resfunc'=>'Alap',
        'sql'=>'SELECT * FROM fajta',
        'trt'=>['app\admin\trt\task\Alap'],
        'view'=>'admintabla.html'
    ];
    static public $form=['trt'=>['app\admin\trt\task\View'],'next'=>'save','view'=>'fajta_form.html'];
   // static public $new=['trt'=>['app\admin\trt\task\Pub'],'next'=>'form'];
    static public $edit=['trt'=>['app\admin\trt\task\Edit'],'next'=>'form','resfunc'=>'unpub'];
    static public $pub=['trt'=>['app\admin\trt\task\Pub'],'next'=>'alap'];
    static public $unpub=['trt'=>['app\admin\trt\task\Pub'],'resfunc'=>'unpub','next'=>'alap'];
    static public $del=['trt'=>['app\admin\trt\task\Del'],'next'=>'alap'];
    static public $joghiba=['trt'=>['app\admin\trt\task\Joghiba']];
    static public $saveuj=['trt'=>['app\admin\trt\task\Joghiba'],'next'=>'alap'];
    static public $save=['trt'=>['app\admin\trt\task\Joghiba'],'next'=>'alap'];

}
TSK::$passwdchange['ell']=[
    'password'=>['regx'=>Regx::$passwd,'Match'=>'$_POST["password2"],"two_passwd_nomatch"'],
    'oldpass'=>['regx'=>Regx::$passwd,'ValidPasswd'=>'"passwd_nomatch"']

];
ADT::$paramT['Ikon_ClikkSor']['ikonsorT']=['new','edit','del','pub','unpub'];
ADT::$paramT['Ikon_ClikkSor']['getID']='task';
ADT::$paramT['Tabla']['dataszerkT']=['chk'=>['nocim'=>true,'func'=>'checkbox_mezo'],'pub'=>['nocim'=>true,'func'=>'pub_mezo'],'username'=>[],'email'=>[]];
ADT::$paramT['Pagin']['limit']='10';
\GOB::$tmpl='admin';
ADT::$LT['lapcim']='Fajta admin';