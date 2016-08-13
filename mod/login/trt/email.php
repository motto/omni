<?php
namespace mod\login\trt;
//LT:reg_email_send,reg_email_nosucces
trait Email{ public function Email()
{
    if(is_file('mod/login/view/email/'.\GOB::$lang.'_confirm.html'))
    {$htFile='mod/login/view/email/'.\GOB::$lang.'_confirm.html';}
    else{$htFile='mod/login/view/email/hu_confirm.html';}
    
    $code=\lib\str\STR::randomSTR(8);
   
    $sql="INSERT INTO tmp (userid,varname,value) VALUES ('".$this->ADT['beszurtid']."','regcode','".$code."')";   
    $res= \lib\db\DBA::parancs($sql) ; 
    
    $changeT=['username'=>$this->ADT['SPT']['username'],'link'=>$_SERVER['HTTP_HOST'].'/index.php?app=base&fg=confirm&id='.$this->ADT['beszurtid'].'&code='.$code];
  
    $parT['cim']=$this->ADT['SPT']['email'];
    $parT['Subject']=$this->ADT['LT']['Email_reg'] ?? 'Email_reg';
    $parT['Body']=\lib\str\STR::Change(file_get_contents($htFile,true),$changeT);
    $res=\mod\email\Email_S::Res($parT);
    
    if($res['bool'])
    {$this->ADT['LT'] =\lib\base\TOMB::langTextToT('info','reg_email_send',$this->ADT['LT']);}
    else
    {$this->ADT['LT'] =\lib\base\TOMB::langTextToT('info','reg_email_nosucces',$this->ADT['LT']);}
}}