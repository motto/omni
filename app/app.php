<?php
namespace app;

defined( '_MOTTO' ) or die( 'Restricted access' );



//ini fileok becsatolása-------------------------------------
$iniF=$_GET['iniF'] ?? \GOB::$app;
$iniF=str_replace('_', '/', $iniF);
include 'app/'.\GOB::$app.'/'.$iniF.'.ini.php';

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
        //nyelvi tömb feltöltése
        $this->SetLT();
   
        //futtatamdó task előállítása
        $this->SetTask();//trt: getTask
        
      /*  $jog=$this->ADT['jog'] ?? 'admin';
        
        if(! \GOB::get_userjog($jog))
        {
           $this->ADT['task']='joghiba';
           $this->ADT['TSK']['joghiba'] ['trt'][]='\app\admin\trt\task\Joghiba';
        }*/
      
        //appNev.$task osztály generálás futtatás
        $this->Task();
        //A $this->ADT['view'] feltöltése modulokkal
        $this->ChangeData();
        $html=$app->html ?? 'base';
        
        //html betöltése
        \GOB::$html=file_get_contents('tmpl/'.\GOB::$tmpl.'/'.$this->ADT['html'],true);
       
        //ini file betöltése
        if(is_file(\GOB::$tmpl.$this->ADT['html'].'.php'))
        {include_once \GOB::$tmpl.$this->ADT['html'].'.php';}
        
        \GOB::$html= str_replace('<!--|content|-->',$this->ADT['view'] ,\GOB::$html);
        
        $this->ChangeMod(); 
        
        $this->ChangeLT();
              
    }
}


$app=new App();
