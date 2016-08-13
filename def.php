<?php
defined( '_MOTTO' ) or die( 'Restricted access' );
function betolt($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    $fileName =strtolower($fileName);//saját (kisbetűsítés) nem igazán kell
    if(is_file($fileName)) { require_once  $fileName;}
  //echo $fileName;
}
function betolt2($className)
{
  $classT= explode('_',$className);
  //echo '---------------'.$classT[0];
    betolt($classT[0]);
}
spl_autoload_register('betolt');
spl_autoload_register('betolt2');
/**
alap trt tomb ha az applikáció taskjában vagy alap osztályában olyan szereplő trait itt megvan 
akor innen tölti be. használja: app\trt\task\TASK
 */
class TRT
{
    public static $LT = 'nem'; //Lt t ömb feltöltését végzi
    public static $save = 'nem';
    public static $view = 'nem';
}

class CONF
{
    public static $offline= false;
    public static $offline_message = 'Weblapunk fejlesztés alatt.';
    public static $baseTRT =[];
    public static $upload_dir='user/share';
    public static $adminok=array(1,2);
    public static $sql_log='full';//lehet 'no','parancs': a lekérdezéseket nem
    //lang----------------------------------- 
    public static $accepted_langT=array('hu','en');
    public static $LangMode='single';
    public static $LangForras='tomb'; //db   
    //db------------------------------- 
/*	public static $felhasznalonev = 'pnet371_menku';
	public static $adatbazis  = 'pnet371_menku_omnihund';
	public static $jelszo = 'motto6814';
    public static $host = 'localhost';
*/	
    public static $host = 'localhost';
    public static $felhasznalonev = 'root';
    public static $jelszo = '';
    public static $adatbazis = 'omnihund';
	
    //mail-------------------------------
    public static $mailfrom= 'motto001@gmail.com';
    public static $fromnev= 'Admin';
    /**
ha false nem küld levelet csak beirja a testemail táblába 
     */
    public static $email=false;  
/**
igen: pub automatikusan, email: mailos konfirmációkor, nem: admin által állítódik nullára
 */
    public static $autopub='email';
    //smtp-----------------------------
    
     /*  public static $smtpHost= 'smtp.processnet.hu'; //null vagy '', ha nem használ smtp-t
    public static $smtpPort= 26;
    public static $smtpUser= 'kapcsolat@omnihund.com';
    public static $smtpPasswd= 'aaaaaa';
    public static $SMTPSecure = 'tls'; //vagy ssl */
 //gmailsmtp-------------------------------
    public static $smtpHost= 'smtp.gmail.com'; 
    public static $smtpPort= 465;
    public static $smtpUser= 'motto001@gmail.com';
    public static $smtpPasswd= 'motto6814';
    public static $SMTPSecure = 'ssl';//// secure transfer enabled REQUIRED for Gmail
   
    //base--------------------
    public static $baseApp='omni';
    /**
üresen kell hagyni ha az alap app.php-akatjuk használni base app-nak
     */
    public static $baseAppdir='omni';
    public static $baseLang='hu';
    public static $baseTmpl='omni';
    public static $title='Social';
/**
ha nincs $user_SQL ez alapján csinál. Csak az userek tábla mezői használhatók!
 */
    public static $user_mezok='id,username,email';

}

class GOB
{ 
	private static $userjog=Array();
/**
mindeféle paraméterek elhelyezése applikációknak ,modulok de a headT helyét is átvette
js css og stb betöltése alapértelmezett kulcsok: $headT['head'],$headT['body'],$headT['bodyend']
 a Fejlec_s::ChangeFull() függvény a kulcsoknak megfelelő html cserestringet (pl.:<!--|head|-->)
  cseréli a tömbértékekből generált stringre
   */  
	public static $paramT=[];
	public static $lang='';
/**
tmpl inicializálásra modulok is tehetik ide a szótáraikat ha nem akarják külön betölteni
lib\html\dom\trt\Dom_HTML_ChangeLT innen tölti fel Aa GOB::$HTML-t AZ ADT['LT']-vel felülrja,kiegészíti
 */	
	public static $LT=''; 
	public static $tmpl='';
	public static $app='';
	public static $appdir='';
	public static $db='';
	public static $html='';
/**
ide regisztrálnak be a modulok hogy ne legyen két ugyanolyan nevű
*/
	public static $modT=[];
/**
ide irányítunk minden rendszerkiiratást err,alert,info
 */   
    public static $echoT=[];
    public static $logT=[];
    
 /**
ki kell vezetni!! szerepét a $logT veszi át aminek egyike altömbje lesz: $logT['hiba']
  */   
    public static $hiba=true;    
    public static $userT=Array();
    
/**
 ez alapján kéredzi le az usertömböt($userT)
 */
    public static $user_mezok='';
    public static $user_SQL='';
    
    /**
     * '' (alapértelmezés) az adminok csak saját cikkeiket szerkeszthetik
     * 'kozos' az adminok egymás cikkeit szerkeszthetik
     * 'tulajdonos' Az adminok szerkeszthetnek minden cikket
     */
    public static $admin_mod='';
    
    public static function get_userjog($jogname){
        if(in_array($jogname,self::$userjog)){return true;}
        else{return false;}
    }
    public static function set_userjog(){
        self::$userjog=\lib\jog\Jog::fromGOB();
    }

}
GOB::$user_mezok=CONF::$user_mezok;


