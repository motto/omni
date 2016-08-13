<?php
namespace mod\login;
defined( '_MOTTO' ) or die( 'Restricted access' );

class ADT{

//fontos--------------------------
public static $captcha=false;
/**
confirm email küldés.
 */
public static $emailConfirm=true;
/**
az ellenőrző függvény false-ra állítja ha hibát talál
 */
public static $ellerr=true;
public static $appDir='mod/login';
public static $task='alap';
public static $tablanev='userek';
/**
hogy több modul is futtathatóó legyen ellenőrizni kell hogy a GOB::modT-ben van -e már ilyen 
modulnév regisztrálva ha igen sorszámozni kell a mod betöltő ez alapján keresi ki a parT-t
 */
public static $obNev='log';
/**
elérési utaknál kelhet
 */
public static $modNev='Login';
/**
ha tobb modul működik együtt pl.: tabla és lapozó akkor ugyanazt a get előtagot használják 
egyébként általában ugyanaz mint az obnev. a task csak simán a getElotag pl.: log=new vagy log=del
 */
public static $getID='log';
/**
 a task trait-nek ha nins a tasknak megfelelő funkciója ilyennel kell rendelkezni (felülírható)
 */
public static $resfunc='Res';
public static $view='';
public static $dataT=[];

/**
ellenőrzott POST adatok (safePost). Ide kell írni (ellenőrzés után !) 
minden adatot, amit adatbázisba akarunk menteni
 */
public static $SPT=[];

/**
ide kell a nyelvi elemeket beírni
 */
public static $LT=[];

}
class Regx{
static public $username=[['/^.{<<MIN>>,<<MAX>>}$/u','long_err',['MEZO'=>'username','MIN'=>'4','MAX'=>'20']],
						['HU_TOBB_SZO','spec_char_err',['MEZO'=>'LT.username']]]	;	
static public $email=	[['/^.{<<MIN>>,<<MAX>>}$/u','long_err',['MEZO'=>'email','MIN'=>'6','MAX'=>'50']],
					 	['MAIL','email_err']];
static public $passwd=	[['/^.{<<MIN>>,<<MAX>>}$/u','long_err',['MEZO'=>'password','MIN'=>'6','MAX'=>'20']]];
}
class TSK{
static public $alap=['trt'=>['mod\login\trt\task\Alap']];	
static public $belepform=['trt'=>['mod\login\trt\task\View'],'view'=>'belep_form.html'];
static public $kilepform=['trt'=>['mod\login\trt\task\View'],'view'=>'kilep_form.html'];
static public $passwdform=['trt'=>['mod\login\trt\task\View'],'view'=>'szerk_passwd.html'];
static public $regform=['trt'=>['mod\login\trt\task\View'],'view'=>'regisztral_form.html'];
static public $passwdchange=['trt'=>['mod\login\trt\task\Save_passwd'],'next'=>'alap','resfunc'=>'Save_passwd'];

static public $kilep=['trt'=>['mod\login\trt\task\Kilep'],'next'=>'alap'];
static public $belep=['trt'=>['mod\login\trt\task\Belep'],'next'=>'alap'];
//static public $passwdmentkesz=['trt'=>['mod\login\trt\task\Alap']];
static public $jelszomail=['trt'=>['mod\login\trt\task\Alap']];
static public $mailconfirm=['trt'=>['mod\login\trt\task\Alap']];

static public $regment=
[
'resfunc'=>'Save_Reg',   
'trt'=>['mod\login\trt\task\Save_Reg'],	
'next'=>'alap',		
'ell'=>[]
];
 
}
//ellenőrzések---------------------------
TSK::$passwdchange['ell']=[
    'password'=>['regx'=>Regx::$passwd,'Match'=>'$_POST["password2"],"two_passwd_nomatch"'],
    'oldpass'=>['regx'=>Regx::$passwd,'ValidPasswd'=>'"passwd_nomatch"']

];


TSK::$belep['ell']=[
	'username'=>['regx'=>Regx::$username],	
	'password'=>['regx'=>Regx::$passwd,'ValidPasswd'=>'"passwd_nomatch"']
];
TSK::$regment['ell']=[
    'username'=>['regx'=>Regx::$username, 'Marvan'=>'"username","user","username_have"'],
	'email'=>['regx'=>Regx::$email,'Marvan'=>'"email","user","email_have"'],	
	'password'=>['regx'=>Regx::$passwd,'Match'=>'$_POST["password2"],"two_passwd_nomatch"']	
];
	
