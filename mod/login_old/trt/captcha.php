<?php
namespace mod\login\trt;
trait Captcha{
    public function Captcha(){
       $cp= \mod\captcha\Captcha_S::Res();
      $this->ADT['view']=str_replace('<!--|captcha|-->', $cp, $this->ADT['view']) ;
    }
}

trait Captcha_CodeEll{
    public function CodeEll($err='captcha_error'){
        $res=[];$res['bool']=false; $res['err']=[$err,[]];
       // $res['toSPT']=false; //ne írja be az ellenőrzött tömbe (ne jelezzen hibát az adatbátzis)
         if(\mod\captcha\Captcha_S::Bool()){
          $res['bool'] = true; unset($res['err']);
        }
        return $res;
       
        
    }
}