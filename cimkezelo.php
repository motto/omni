<?php 
//defined( '_MOTTO' ) or die( 'Restricted access' );
$url = substr($_SERVER['REQUEST_URI'], 1);
echo '---------------------nincs ilyen almappa';
if($url=='admin/' or $url=='admin'){
//header('Location:http://'.$_SERVER['HTTP_HOST'].'/index.php?com=admin');
header('Location:/index.php?com=admin');
}else{
//header('Location:http://'.$_SERVER['HTTP_HOST'].'/index.php?com=admin&view=article&id=20&aruhazcim='.$url.'');
echo 'nincs ilyen almappa';
}



//$_SERVER['HTTP_REFERER']
//eredeti cím http://infolapok.hu/antikvarium/cimkezelo.php?option=com_content&id=45 
//$_SERVER['HTTP_HOST']= infolapok.hu (lehet aldomain is pl.: konyves.infolapok.hu)
//$_SERVER['REQUEST_URI']=/antikvarium/cimkezelo.php?option=com_content&id=45 
//$_SERVER['REMOTE_ADDR']=kliens ip címe: 87.242.28.103
//$_SERVER['PHP_SELF']=/antikvarium/cimkezelo.php (Vigyázat a php file címe nem az eredetileg beírt cím domain utáni része tehát ha a http://konyves.infolapok.hu/proba címrõl 404-es oldallal átirányítjuk a címkezelõre értéke:/cimkezelo.php leszés nem proba.)
//$_SERVER['QUERY_STRING']=option=com_content&id=45 

//$url = $_SERVER['PHP_SELF'];
	/*$id = $_GET['id'];
		$url2 = $_SERVER['REQUEST_URI'];
	$ujurl='Location:'. $url2;*/
//http://berenyi.helyiakciok.hu/index.php	

//header('Location:http://helyiakciok.hu/index.php?option=com_content&view=article&id=20&aruhazcim='.$url.'');
/*echo'a keresett oldal nem található: '.$_SERVER['PHP_SELF'];
 print '<h1>A $_SERVER tartalma</h1>';
 foreach ($_SERVER as $kulcs => $ertek){
   print "$kulcs : $ertek <br>\n";
 }
 A $_SERVER tartalma
HTTP_HOST : proba.infolapok.hu
HTTP_USER_AGENT : Mozilla/5.0 (Windows NT 6.1; rv:17.0) Gecko/20100101 Firefox/17.0
HTTP_ACCEPT : text/html,application/xhtml+xml,application/xml;q=0.9,;q=0.8
HTTP_ACCEPT_LANGUAGE : hu-hu,hu;q=0.8,en-US;q=0.5,en;q=0.3
HTTP_ACCEPT_ENCODING : gzip, deflate
HTTP_CONNECTION : keep-alive
HTTP_REFERER : http://proba.infolapok.hu/index.php?option=com_content&view=article&id=20&aruhazcim=images/cb_sample_01.jpg
HTTP_COOKIE : __utma=248289119.923746375.1337270772.1338487227.1338715393.4
HTTP_CACHE_CONTROL : max-age=0
PATH : /usr/local/bin:/usr/bin:/bin
SERVER_SIGNATURE :
Apache/2.2.20 (Ubuntu) Server at proba.infolapok.hu Port 80

SERVER_SOFTWARE : Apache/2.2.20 (Ubuntu)
SERVER_NAME : proba.infolapok.hu
SERVER_ADDR : 94.125.177.120
SERVER_PORT : 80
REMOTE_ADDR : 87.242.27.123
DOCUMENT_ROOT : /home/www/pnet354_cgyloqik/public_html/proba
SERVER_ADMIN : hostmaster@processnet.hu
SCRIPT_FILENAME : /home/www/pnet354_cgyloqik/public_html/proba/index.php
REMOTE_PORT : 22101
GATEWAY_INTERFACE : CGI/1.1
SERVER_PROTOCOL : HTTP/1.1
REQUEST_METHOD : GET
QUERY_STRING : option=com_content&view=article&id=20&aruhazcim=images/cb_sample_01.jpg
REQUEST_URI : /index.php?option=com_content&view=article&id=20&aruhazcim=images/cb_sample_01.jpg
SCRIPT_NAME : /index.php
PHP_SELF : /index.php
REQUEST_TIME : 1355691638 
 
  print '<h1>A $_COOKIE tartalma</h1>';
 foreach ($_COOKIE as $kulcs => $ertek){
   print "$kulcs : $ertek <br>\n";
 }
 print '<h1>A $_FILES tartalma</h1>';
 foreach ($_FILES as $kulcs => $ertek){
   print "$kulcs : $ertek <br>\n";
 }
 print '<h1>A $_REQUEST tartalma</h1>';
 foreach ($_REQUEST as $kulcs => $ertek){
   print "$kulcs : $ertek <br>\n";
 }
 print '<h1>A $_SESSION tartalma</h1>';
 foreach ($_SESSION as $kulcs => $ertek){
   print "$kulcs : $ertek <br>\n";
 }
 print '<h1>A $_GET tartalma</h1>';
 foreach ($_GET as $kulcs => $ertek){
   print "$kulcs : $ertek <br>\n";
 }
 print '<h1>A $_POST tartalma</h1>';
 foreach ($_POST as $kulcs => $ertek){
   print "$kulcs : $ertek <br>\n";
 }
 */
?>