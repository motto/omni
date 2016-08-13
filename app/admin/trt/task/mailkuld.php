<?php
namespace app\admin\trt\task;
//LT:Email reg,reg_email_send
trait Mailkuld{ 

public function Mailkuld()
{   $task=$this->ADT['task'];

    $parT['cim']=$_SESSION['idT'] ?? [];
    unset($_SESSION['idT']);
    
    if(empty($parT['cim']))
    { 
        $this->ADT['LT'] =\lib\base\TOMB::errLog('mailcim_empty',$this->ADT['LT']);
        $this->ADT['TSK'][$task]['next']='email';
    }
    else 
    {   
    $parT['Subject']=$_POST['subject'] ?? 'no subject';
    $parT['Body']=$_POST['body'] ?? '';
    
        if($parT['Body']!='')
        {  
           $parT['SetFrom']= $_POST['setfrom'] ?? \CONF::$mailfrom;
           $parT['fromnev']= $_POST['fromnev'] ?? \CONF::$fromnev;
    
           $res=\mod\email\Email_S::Res($parT);
              if($resT['bool']=false)
              {  
                  $this->ADT['LT'] =\lib\base\TOMB::errLog('email_failed',$this->ADT['LT']);
                  $this->ADT['TSK'][$task]['next']='email';
              }
            
        }
        else
        {
            $this->ADT['LT'] =\lib\base\TOMB::errLog('email_body_empty',$this->ADT['LT']);
             $this->ADT['TSK'][$task]['next']='email';
        }
    }
}}