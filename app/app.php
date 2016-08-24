<?php
namespace app;

defined( '_MOTTO' ) or die( 'Restricted access' );



//ini fileok becsatolása-------------------------------------
$iniF=$_GET['iniF'] ?? \GOB::$app;
$iniF=str_replace('_', '/', $iniF);
include 'app/'.\GOB::$app.'/'.$iniF.'.ini.php';

//$loginTRT['SetLT']='\lib\lang\trt\\'.\CONF::$LangMode.'\\'.\CONF::$LangForras.'\Set_SetLT';
$TRTbase['AppIni']='\app\admin\trt\task\AppIni';
$TRTbase['SetLT']='\app\trt\Empty_SetLT';
$TRTbase['SetTask']='\app\trt\Empty_SetTask';
//$TRT['GetJog']='\lib\task\trt\Task_PG_GetTask';
$TRTbase['Task']='\app\trt\Empty_Task';
$TRTbase['ChangeLT']='\app\trt\Empty_ChangeLT';
$TRTbase['ChangeData']='\app\trt\Empty_ChangeData';
$TRTbase['ChangeMod']='\app\trt\Empty_ChangeMod';
if(isset($TRT)){$TRT=array_merge ($TRTbase,$TRT);}
else{$TRT=$TRTbase;}

eval(\lib\base\Ob_TrtS::str('AppBase',$TRT));

class App extends \AppBase
{
    public $ADT=[]; 

    public function __construct($parT = []){
       $this->ADT = get_class_vars('app\ADT');
       $this->ADT['TSK']=get_class_vars('app\TSK');
       $this->ADT['idT']=$this->ADT['dataT']['idT']=$_POST['idT'] ?? [];
       
       
       $this->App();
    
    }
 
    public function App()
    {
        //több task által használt alap értékek ,illetve az adott task 
        //környezet függő értékei
        $this->AppIni();
        
        //nyelvi tömb feltöltése
        $this->SetLT();
   
        //futtatamdó task előállítása és az ADT-be írása
        $this->SetTask();//trt: getTask
        
        //appNev.$task osztály generálás futtatás
        $this->Task();
        //A $this->ADT['view'] feltöltése modulokkal
        $this->ChangeData();
        $html=$app->html ?? 'base';
        
        //html betöltése
        if(is_file('tmpl/'.\GOB::$tmpl.'/'.$this->ADT['html']))
        { \GOB::$html=file_get_contents('tmpl/'.\GOB::$tmpl.'/'.$this->ADT['html'],true);}
        else{\GOB::$html=$this->ADT['html'];}
       
        //ini file betöltése
        if(is_file(\GOB::$tmpl.$this->ADT['html'].'.php'))
        {include_once \GOB::$tmpl.$this->ADT['html'].'.php';}
        
        \GOB::$html= str_replace('<!--|content|-->',$this->ADT['view'] ,\GOB::$html);
        
        $this->ChangeMod(); 
        
        $this->ChangeLT();
              
    }
}


$app=new App();
