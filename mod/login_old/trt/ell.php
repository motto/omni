<?php
namespace  mod\login\trt;
defined( '_MOTTO' ) or die( 'Restricted access' );
//futtatandó: Ell(); \lib\ell\trt\Ell;-ből
trait Ell{
    use \lib\ell\trt\Ell;
    use \lib\ell\trt\Regx;
    use \lib\ell\trt\Ell_Match;
    use \lib\ell\trt\DB_Marvan;
    use \lib\ell\trt\DB_ValidPasswd;

}