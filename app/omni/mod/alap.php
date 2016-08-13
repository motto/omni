<?php
namespace app\omni\mod;

class Alap{

    static public function Alap(){
        \GOB::$html=file_get_contents('tmpl/omni/base2.html',true);

        return '<h2>Eza az alap oldal </h2><div style="" >Akkor jelenik meg, ha olyan felhasználó jön aki
            már regisztrált is, és választott is fajtát. 
<h2>Választott fajta: '.\GOB::$userT['var'].'</h2>
			Lehetne itt például  a webshop, vagy hírek, infók...</div> ';
    }
}