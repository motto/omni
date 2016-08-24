<?php
namespace mod\login\trt\task;

defined('_MOTTO') or die('Restricted access');
// LT: reg_kesz,reg_kesz_admin_aktival, reg_kesz_email_aktival, database_err,passwd_saved
class Save_S{
  static   public function SaveFromSPT($ADT,$insert=true,$err='database_err')
    {
        $task=$ADT['task'];
        $ADT['saveRes']=true;
        
            if(isset($ADT['SPT']['password']))
            {$ADT['SPT']['password']=md5($ADT['SPT']['password']);}
            if(isset($ADT['TSK'][$task]['noSave']))
            {
              foreach($ADT['SPT'] as $key=>$value)
              {
                   if(!in_array($key,$ADT['TSK'][$task]['noSave']))
                   {      
                    $saveT[$key]=$value; 
                   }  
              }
            }else{$saveT=$ADT['SPT'];}
            
            if($insert){
             $beszurtid=\lib\db\DBA::beszur_tombbol($ADT['tablanev'],$saveT);
             $ADT['beszurtid']=$beszurtid;
            }else{
               $res= \lib\db\DBA::frissit_tombbol($ADT['tablanev'],$ADT['idT'][0],$saveT,$test=false);
                
            }
            $hiba=\GOB::$logT['hiba']['pdo'][0] ?? '';
            if($hiba!='')
            {
                $ADT['saveRes']=false;
                $ADT['LT']=\lib\base\TOMB::langTextToT('err',$hiba,$ADT['LT']);               
            }
            
          
 return $ADT ;
    }
    
}
trait Save{
use \mod\login\trt\Ell;
public function Save($hibaTask,$info)
    {   
        $task=$this->ADT['task'];
        $this->ADT['TSK'][$task]['next']=$hibaTask;
        

        if ($this->Ell()) {

            $this->ADT=\mod\login\trt\task\Save_S::SaveFromSPT($this->ADT) ;
            
            if ($this->ADT['saveRes']) {
                 
                $this->ADT['LT'] =\lib\base\TOMB::langTextToT('info',$info,$this->ADT['LT']);
                $this->ADT['TSK'][$task]['next']='alap';
            }
       
             
        }
    }

}

trait Save_Reg{ 
use \mod\login\trt\Ell;
use \mod\login\trt\Email;

public function Save_Reg()
{ if ($this->Ell()) 
   { 
        if(\CONF::$autopub=='igen'){$pub='0';}else{$pub='1';}
        
        $sql="INSERT INTO userek (username,email,password,pub) VALUES ('".$this->ADT['SPT']['username']."','".$this->ADT['SPT']['email']."','".md5($this->ADT['SPT']['password'])."','".$pub."')";
        $res= \lib\db\DBA::beszur($sql);
        //echo $sql;
       // print_r($res);
        if ($res['bool'])
        {
            $this->ADT['beszurtid']=$res['id'];
            
            if(\CONF::$autopub=='igen'){$info='reg_kesz';}
            if(\CONF::$autopub=='email'){$info='reg_kesz_email_aktival';}
            if(\CONF::$autopub=='nem'){$info='reg_kesz_admin_aktival';}
            
            if($this->ADT['emailConfirm']){$this->Email() ;} 
            $this->ADT['LT'] =\lib\base\TOMB::langTextToT('info',$info,$this->ADT['LT']);
        }
        else{\lib\base\TOMB::langTextToT('err','database_err',$this->ADT['LT']);}
    }
}
}
trait Save_passwd{
 
use \mod\login\trt\Ell;

public function Save_passwd($info='passwd_saved')
{       

    $task=$this->ADT['task'];
    $this->ADT['TSK'][$task]['next']='passwdform'; 
        //print_R
   if ($this->Ell()) 
   { 
 
         $sql= "UPDATE userek SET password='".md5($this->ADT['SPT']['password'])."' WHERE id='".$_SESSION['userid']."'";
         $res= \lib\db\DBA::parancs($sql)   ;
//echo $sql;
            if ($res['bool']) 
            {     
                $this->ADT['LT'] =\lib\base\TOMB::langTextToT('info',$info,$this->ADT['LT']);
                $this->ADT['TSK'][$task]['next']='alap';
            }
           else {}
  
             
     }
} }

