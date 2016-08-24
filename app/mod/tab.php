<?php

namespace app\mod;
defined( '_MOTTO' ) or die( 'Restricted access' );

class Tab_emailcim_S
{

    static public function Res()
    {
        
        $sql="SELECT * FROM eposted WHERE emailid='".$_GET['emailid']."'";
        $parT['dataT']=\lib\db\DB::assoc_tomb($sql);
        $parT['dataszerkT']=[
            'touserid'=>['cim'=>'userid'],
            'cim'=>['cim'=>'emailcim'],
            'res'=>['cim'=>'Sttusz'],
            'datum'=>['cim'=>'Dátum']];
         return \mod\tabla\Tabla_S::Res($parT);
    }
}
class Tab_email_S
{

    static public function Res()
    {
        $res='';
        $sql="SELECT * FROM email WHERE id='".$_GET['emailid']."'";
        $dataT=\lib\db\DB::assoc_sor($sql);
        if(isset($dataT)){
            
          $res.='<h5>Feladó:'.$dataT['setfrom'].'</h5>';
        $res.='<h5>Címzett:'.$dataT['cim'].'</h5>';
        $res.='<h5>statusz:'.$dataT['res'].'</h5>';
        $res.='<h5>Tárgy:'.$dataT['subject'].'</h5>';
        $res.='<h5>Üzenet:'.$dataT['body'].'</h5>';  
        }
        else{$res='nincs adat';}
        return $res;
    }
}