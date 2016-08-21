<?php
namespace mod;

defined( '_MOTTO' ) or die( 'Restricted access' );



class Mod 
{
    public $ADT=[]; 

    public function __construct($parT = [],$iniclass=''){
   
       $this->modinit($parT,$iniclass);
       $this->Mod();
    
    }
    
    /*
   static public function TRTinit($trtT=[],$baseTRTchangeT=[])
    { 
       //TRT tömb üres traitekkel felöltése (nem csinálnak semmit)
        $resT = get_class_vars('\mod\Mod_EmpTRT');
        $resT=array_merge ($resT,$trtT);
        
        //A TRT tömb felülírása a \TRT-vel (alapértékek) ha a $this->ADT['baseTRTchangeT'] nem üres
        foreach ($baseTRTchangeT as $chTRT)
        {
            if (isset(\TRT::$$chTRT)){$resT[$chTRT]=\TRT::$$chTRT;}
        
        }
     return $resT ;
        
    }*/
    public function modinit($parT,$iniclass)
    {
        $this->ADT['idT']=$this->ADT['dataT']['idT']=$_POST['idT'] ?? [];
 
        //Az alapértékek betöltése a $iniclass osztálybóll
        if($iniclass!=''){$this->ADT = get_class_vars($iniclass);}   
        $this->ADT=array_merge ($this->ADT,$parT);  
    }
 
    public function Mod()
    {
        $this->AppIni();
       //nyelvi tömb feltöltése
       $this->SetLT();
  
        //futtatamdó task előállítása
        $this->SetTask();//trt: getTask
     //   $jog=$this->ADT['jog'] ?? 'admin';
        
      /*  if(! \GOB::get_userjog($jog))
        {
           $this->ADT['task']='joghiba';
           $this->ADT['TSK']['joghiba'] ['trt'][]='\app\admin\trt\task\Joghiba';
        }*/
      
        //appNev.$task osztály generálás futtatás
        $this->Task();
        
        //A $this->ADT['view'] feltöltése modulokkal
        $this->ChangeData();
        
        $this->ChangeMod(); 
        
        $this->ChangeLT();
              
    }
}
