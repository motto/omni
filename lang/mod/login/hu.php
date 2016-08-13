<?php
namespace lang\mod\login;
class LT{
    public static $hu=[
        'long_err'	=>'A(z) <<MEZO>> mezonerk min <<MIN>>, max <<MAX>> karakternek kell lenni!',
        'spec_char_err'	=>'A(z) <<MEZO>> nem tartalmazhat speciális karaktereket.',
        'login_data_nomatch'=>'A felhasználónév vagy a jelszó nem jó!',
        'passwd_nomatch'=>'A jelszó vagy a felhasználónév nem jó!',
        'oldpasswd_err'=>'A régi jelszó nem jó!',
        'newpasswd_nomatch'=>'A jelszavak nem egyeznek!',
        'username_have'=>'Már van ilyen felhasználónév',
        'email_have'=>'Ezzel az email címmel már regisztráltak!',
        'email_err'=>'Nem szabványos email!',
        'joghiba'=>'Jogosultság hiba!',
        'dberror'=>'Adatbázis hiba',

        'username'=>'Felhasználónév',
        'reg'=>'Regisztrálás',
        'cancel'=>'Mégsem',
        'logout'=>'Kilépés',
        'login'=>'Belépés',
        'passwd'=>'Jelszó',
        'regi_jelszo'=>'Régi jelszó',
        'uj_jelszo'=>'Új jelszó',
        'uj_megegyszer'=>'Új jelszo mégegyszer',
        'passwd_change'=>'Jelszó változtatás',
        'ment'=> 'Ment',
        'megsem'=>'Mégsem'
    ];

    public static $multi=[
        'username'=>[
            'hu'=>'Usernév',
            'en'=>'Username'],
        'reg'=>[
            'hu'=>'Regisztrálás',
            'en'=>'Registring'],
        'cancel'=>[
            'hu'=>'Mégsem',
            'en'=>'Cancel'],
        'logout'=>[
            'hu'=>'Kilépés',
            'en'=>'Logout'],
        'login'=>[
            'hu'=>'Belépés',
            'en'=>'Login'],
        'usernamelong_err'=>[
            'hu'=>'A felhasználó névnek min 5 max 20 karakternek kell lenni!',
            'en'=>'The username must be min 5 max 20 char long'],
        'spec_char_error'=>[
            'hu'=>'A felhasználó név nem tartalmazhat "különleges karaktereket" ! Csak kis és nagybetűket (ékeztest is), szóközöket és számokat',
            'en'=>'The username is not special char'],
        'login_data_nomatch'=>[
            'hu'=>'A felhasználónév vagy a jelszó nem jó!',
            'en'=>'Bad username or passwd!'],
        'oldpasswd_err'=>[
            'hu'=>'A régi jelszó nem jó!',
            'en'=>'The old password no match!'],
        'newpasswd_nomatch'=>[
            'hu'=>'A két új jelszó nem egyezik!',
            'en'=>'The new passwords no match!'],
        'username_have'=>[
            'hu'=>'Már van ilyen felhasználónév',
            'en'=>'This username is registered!'],
        'joghiba'=>[
            'hu'=>'Jogosultság hiba!',
            'en'=>'Restricted area!'],
        'dberror'=>[
            'hu'=>'Adatbázis hiba',
            'en'=>'DB error'],
        'passwd'=>[
            'hu'=>'Jelszó',
            'en'=>'Password'],
        'regi_jelszo'=>[
            'hu'=>'Régi jelszó',
            'en'=>'Old password'],
        'uj_jelszo'=>[
            'hu'=>'Új jelszó',
            'en'=>'New password'],
        'uj_megegyszer'=>[
            'hu'=>'Új jelszo mégegyszer',
            'en'=>'Repeat new Password'],
        'passwd_change'=>[
            'hu'=>'Jelszó változtatás',
            'en'=>'Change password'],
        'ment'=>[
            'hu'=>'Ment',
            'en'=>'Save'],
        'megsem'=>[
            'hu'=>'Mégsem',
            'en'=>'Cancel']
    ];

}