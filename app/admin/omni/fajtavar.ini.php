<?php
namespace app;
defined( '_MOTTO' ) or die( 'Restricted access' );
//echo 'userek';

//\GOB::$paramT['html']['head']['jsfile'][]='mod/media/media.js';
\GOB::$paramT['html']['head']['jsGOBstr']['start_dir']='omni/fajtak';
\GOB::$tmpl='admin';
ADT::$paramT['Ikon_ClikkSor']['imagesize']='35';
ADT::$paramT['Ikon_ClikkSor']['ikonsorT']=['new','edit','del','pub','unpub'];
ADT::$paramT['Ikon_ClikkSor']['getID']='task';
ADT::$paramT['Tabla']['dataszerkT']=['chk'=>['nocim'=>true,'func'=>'checkbox_mezo'],
    'pub'=>['nocim'=>true,'func'=>'pub_mezo'],'kep'=>['cim'=>'Kép'],'nev'=>['cim'=>'Fajtanév'],
    'intro'=>['cim'=>'Rövid ismeretető'],'text'=>['cim'=>'Leírás']];
ADT::$paramT['Pagin']['limit']='50';
$fajta= $_GET['fajta'] ?? '';
ADT::$LT['lapcim']=ucwords($fajta).' fajtaváltozatok';

//$loginTRT['SetLT']='\lib\lang\trt\\'.\CONF::$LangMode.'\\'.\CONF::$LangForras.'\Set_SetLT';
$TRT['AppIni']='\app\admin\trt\task\AppIni';

$TRT['SetLT']='\lib\lang\trt\single\tomb\Set_SetLT';
$TRT['SetTask']='\app\trt\Task_ADT_SetTask';
//$TRT['GetJog']='\lib\task\trt\Task_PG_GetTask';
$TRT['Task']='\app\trt\Task';
$TRT['ChangeLT']='\lib\html\dom\trt\ Dom_HTML_ChangeLT';
$TRT['ChangeData']='\lib\html\dom\trt\Dom_ChangeDatPar';
$TRT['ChangeMod']='\lib\html\dom\trt\Dom_ChangeModHTML';
class Regx{
    static public $input=[['/^.{<<MIN>>,<<MAX>>}$/u','long_err',['MEZO'=>'username','MIN'=>'4','MAX'=>'50']],
        ['HU_TOBB_SZO','spec_char_err',['MEZO'=>'LT.mezo']]]	;
    static public $text=	
      [ ['HU_TOBB_SZO','spec_char_err',['MEZO'=>'LT.tex']]];
    
}

TSK::$save['ell']=[
    //'GET_fajtaid'=>['nincsEll'=>''],
    'GET_fajtaid'=>['regx'=>[
        ['/^.{<<MIN>>,<<MAX>>}$/u','long_err',['MEZO'=>'nev','MIN'=>'1','MAX'=>'10']],
        ['EGESZ_POZ','just_number_err',['MEZO'=>'LT.fajtaid']]
    ]],
    'nev'=>['regx'=>[
        ['/^.{<<MIN>>,<<MAX>>}$/u','long_err',['MEZO'=>'nev','MIN'=>'2','MAX'=>'50']],
        ['HU_TOBB_SZO','spec_char_err',['MEZO'=>'LT.nev']]
     ]],
    'kep'=>['regx'=>[
        ['/^.{<<MIN>>,<<MAX>>}$/u','long_err',['MEZO'=>'kep','MIN'=>'4','MAX'=>'200']]
     ]],  
    'intro'=>['regx'=>[
        ['/^.{<<MIN>>,<<MAX>>}$/u','long_err',['MEZO'=>'username','MIN'=>'0','MAX'=>'200']],
        ['HU_TOBB_SZO','spec_char_err',['MEZO'=>'LT.intro']]
    ]],
    'text'=>['regx'=>[
        ['/^.{<<MIN>>,<<MAX>>}$/u','long_err',['MEZO'=>'text','MIN'=>'0','MAX'=>'2000']],
        ['HU_TOBB_SZO','spec_char_err',['MEZO'=>'LT.text']]
    ]]];


class ADT{

    //fontos--------------------------
    public static $jog='admin';
    public static $appDir='admin/omni';//kell ha az app inifile-ból fut
    public static $html='admin.html';
    public static $listaview='app/omni/view/fajta_thumb.html';
    public static $task='alap';
    public static $idT=[];
    public static $tablanev='fajtavar';
    public static $ellerr=true;
    public static $mentmezoT=['fajtaid','nev','kep','intro','text'];
    /**
     a task trait-nek ha nins a tasknak megfelelő funkciója ilyennel kell rendelkezni (felülírható)
     */
    public static $resfunc='Res';
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
        'sql'=>'SELECT * FROM fajtavar WHERE fajtaid=\'".$_GET[\'fajtaid\']."\'',
        'trt'=>['app\admin\trt\task\Alap_lista'],
        'view'=>'admintabla.html'
    ];
    static public $new=['trt'=>['app\admin\trt\task\View'],'view'=>'fajta_form.html','resfunc'=>'View'];
        // static public $new=['trt'=>['app\admin\trt\task\Pub'],'next'=>'form'];
    static public $edit=['trt'=>['app\admin\trt\task\Edit'],'next'=>'new','resfunc'=>'Edit'];
    static public $pub=['trt'=>['app\admin\trt\task\Pub'],'next'=>'alap','resfunc'=>'Pub',];
    static public $unpub=['trt'=>['app\admin\trt\task\Pub'],'resfunc'=>'unpub','next'=>'alap'];
    static public $del=['trt'=>['app\admin\trt\task\Del'],'resfunc'=>'Del','next'=>'alap'];
  //  static public $joghiba=['trt'=>['app\admin\trt\task\Joghiba'],'resfunc'=>'Joghiba'];
    static public $save=['trt'=>['app\admin\trt\task\Save'],'resfunc'=>'Save','next'=>'alap'];

}

