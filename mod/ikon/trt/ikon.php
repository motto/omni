<?php
namespace mod\ikon\trt;
trait Ikon_Init_TR
{
  public function Ikon_Init($parT)
    {
        $this->ADT['ParamT']['Ikon'] = get_class_vars('\mod\ikon\ADT');

        foreach ($parT as $name => $value)
        {$this->ADT['mod']['ikon'][$name]=$value;}
         
    }
}



trait Ikon_TR
{
// use \mod\ikon\Ikon_Init_TR; 
 
    public function Ikon($parT=[])
    {
      $ikonT= $this->ADT['paramT']['ikon'] ?? [];
      $paramT=array_merge ($ikonT,$parT);
      return \mod\ikon\Ikon_S::Res($paramT);         
    }
}

trait  Ikon_Clikk_TR 
{
//use \mod\ikon\Ikon_Init_TR;

  public function Ikon_Clikk($parT=[])
    {
       $ikonT= $this->ADT['paramT']['ikon'] ?? [];
       $paramT=array_merge ($ikonT,$parT);
       return \mod\ikon\Ikon_Clikk_S::Res($paramT);
         
    }

}  

trait Ikon_ClikkSor_TR
{
//use \mod\ikon\Ikon_Init_TR;
public function Ikon_ClikkSor($parT=[])
    {
       $ikonT= $this->ADT['paramT']['Ikon'] ?? [];
       $paramT=array_merge ($ikonT,$parT);
       return \mod\ikon\Ikon_ClikkSor_S::Res($paramT);
         
    }
   
}


