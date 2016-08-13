<?php
namespace app\base;

defined( '_MOTTO' ) or die( 'Restricted access' );

  \GOB::$html=file_get_contents('tmpl/'.\GOB::$tmpl.'/base2.html',true);

$file=$_GET['fg'] ?? '';
if($file!=''){
    // abstract class ApBase{}
    include_once 'app/base/'.$file.'.php';  
}
else
{
    
$sap=$_GET['sapp'] ?? 'base';    //subApp (könyvtár)
$ini=$_GET['in'] ?? 'base';    //ini file ami az ADT és a TSK ostályokat tartalmazza
                               // és a baseTRT tömböt 
include_once 'app/base/'.$sap.'/'.$ini.'.php';   


$GTRT=get_class_vars('\TRT');

foreach($TRT as $key=>$tr)
{
    $TRT[$key]=$GTRT[$key] ?? $tr;
}

eval(\lib\base\Ob_TrtS::str('AppBase',$TRT));



trait EvalFunc
{
     public function EvalFunc()
     {
        $task=$this->ADT['task'];
        eval($this->ADT['TSK'][$task]['evalSTR']);
    }  
    
}

class App extends \AppBase
{
    public $ADT=[]; //az Ob_Trt::str -el előállított osztályokban benne van!

    public function __construct($parT = []){
       // $this->ADT = get_class_vars('app\admin\ADT');
        //$this->ADT['TSK']=get_class_vars('app\admin\TSK');
        $this->Admin();
    
    }
 
    public function Admin()
    {
        //nyelvi tömb feltöltése
        $this->SetLT();
        $this->ADT['idT']=$this->ADT['dataT']['idT']=$_POST['idT'] ?? [];
      
        if(is_file(\GOB::$tmpl.$this->ADT['html'].'.php'))
        {include_once \GOB::$tmpl.$this->ADT['html'].'.php';}
         
        //futtatamdó task előállítása
        $this->GetTask('task');//trt: getTask
  
        //appNev.$task osztály generálás futtatás
        $this->Task();
        //A $this->ADT['view'] feltöltése modulokkal
        $this->ChangeData();
         \GOB::$html= str_replace('<!--|content|-->',$this->ADT['view'], \GOB::$html);
        $this->ChangeMod(); 
        
        $this->ChangeLT();
              
    }
}

}
$app=new App();
$login= \mod\login\Login_S::Res();
//$content=\app\omni\mod\Fajtak::csoportListaz();
\GOB::$html= str_replace('<!--|login|-->',$login ,\GOB::$html);


