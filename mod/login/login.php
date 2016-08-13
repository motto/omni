<?php
namespace mod\login;

defined( '_MOTTO' ) or die( 'Restricted access' );
include_once 'mod/login/par.php';
include_once 'mod/login/lt.php';

/**
ha sima use-val használjuk a traiteket nem tudunk beépíteni változókat pl:CONF::$LangMode
azért kell associativ tömb hogy felül  írható legyen!
 */
//$loginTRT['SetLT']='\lib\lang\trt\\'.\CONF::$LangMode.'\\'.\CONF::$LangForras.'\Set_SetLT';
$loginTRT['SetLT']='\lib\lang\trt\single\tomb\Set_SetLT';
$loginTRT['GetTask']='\lib\task\trt\Task_PG_GetTask';
$loginTRT['Task']='\lib\task\trt\Task';
$loginTRT['ChangeLT']='\lib\html\dom\trt\Dom_ChangeLT';
$loginTRT['ChangeData']='\lib\html\dom\trt\Dom_ChangeData';

eval(\lib\base\Ob_TrtS::str('loginbase',$loginTRT));

/*
class loginbase {
    use \lib\lang\trt\single\tomb\Set_SetLT;
    use \lib\task\trt\Task_PG_GetTask;
    use \lib\html\dom\trt\Dom_ChangeLT;
    use \lib\html\dom\trt\Dom_ChangeData;
}
*/
class Login extends \loginbase
{ 
	public $ADT=[]; //az Ob_Trt::str -el előállított osztályokban benne van!
	
	public function __construct($parT = []){
		$this->ADT = get_class_vars('mod\login\ADT');
		$this->ADT['TSK']=get_class_vars('mod\login\TSK');
		$this->setADT($parT); 
		if($this->ADT['captcha']){
		  $this->ADT['TSK']['regform']['trt'][]='mod\login\trt\Captcha';
		  $this->ADT['TSK']['regform']['after']='Captcha';
		  
		  $this->ADT['TSK']['regment']['trt'][]='mod\login\trt\Captcha_CodeEll';
		  $this->ADT['TSK']['regment']['ell']['captcha']['CodeEll']='"captcha_err"';
		}
	}
	public function setADT($parT = []){
		foreach ($parT as $name => $value)
		{$this->ADT[$name]=$value;}
	}

    public function Res($parT=[])
    {
       $this->ADT['LT']=\mod\login\LT::$hu;
       $this->GetTask($this->ADT['getID']);//trt: getTask
  
        //modulnev+task osztály generálás futtatás
        $this->Task(); 
        
        //a form submit name="" paraméter cseréje az aktuális task névre ($this->ADT['getID'])
        $this->ADT['dataT']['task']=$this->ADT['getID'];
        $this->ChangeData(); 
          
     // A :view feltöltése nyelvi elemekkel
        $this->ChangeLT();
        return $this->ADT['view'];
    }
 
}

class Login_S
{
	static public function Res($parT=[]){
		
		$ob=new Login();
		return $ob->Res($parT);
	}
	
}