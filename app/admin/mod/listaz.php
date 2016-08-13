<?php
class Listaz
{
    public $ADT=[];
    public function __construct($parT=[])
    {
        $this->ADT['sql']='';
        $this->ADT=array_merge ($this->ADT,$parT);
    }
    public function Listaz()
    {  
        
       return mod\tabla\Tabla_S::Res($this); 
    }    
}