<?php
namespace mod\media;

class ADT{
public static $jog='user';    
public static $feltolt_mezo='fileToUpload';
public static $user_rootdir='res/images/user';
public static $admin_rootdir='res/images';
public static $dir='';
public static $src_torol='res/ico/16/torol.png';
public static $hidden_dirs= ['62','share','thumb'];
public static $view_filetipus= array('jpg','jpeg','gif','png'); //ha üres minddententged
//---------------------------------
public static $ellerr=true;
public static $appDir='mod/media';
public static $task='alap';
public static $tablanev='media';
public static $obNev='media';
public static $modNev='Media';
public static $getID='med';
public static $resfunc='Res';
public static $view='';
public static $dataT=[];
public static $SPT=[];
public static $LT=[];
public static $TSK=['alap'=>['trt'=>['\mod\media\trt\task\Alap'],'resfunc'=>'Alap'],
    'upload'=>['trt'=>['\mod\media\trt\task\Upload'],'resfunc'=>'Upload'],
    'del'=>['trt'=>['\mod\media\trt\task\Alap_Del'],'resfunc'=>'Del'],
    'lista'=>['trt'=>['\mod\media\trt\task\Alap_Lista'],'resfunc'=>'Lista'],
    'newdir'=>['trt'=>['\mod\media\trt\task\Alap_Newdir'],'resfunc'=>'Newdir'],
    'dirchange'=>['trt'=>['\mod\media\trt\task\Alap_Dirchange'],'resfunc'=>'Dirchange'],
    'joghiba'=>['trt'=>['\Base_Joghiba'],'resfunc'=>'Joghiba']
];
}

class Media extends \mod\Mod 
{
    use \app\trt\Empty_SetLT;  //üres trait
    use \Base_SetTask; 
    use \Base_Task; 
    use \Base_ChangeLT ;
    use \Base_ChangeData;
    use \Base_ChangeModView;
    use \mod\media\trt\task\Alap_ini; //AppIni();
    //use \Base_Joghiba; 
}

class Media_s
{
    static public function Res($parT=[])
    {
        $ob=new Media($parT,'\mod\media\ADT');
        return $ob->ADT['view'];
    }
}

