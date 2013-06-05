<?php


class SessionPerso{
    
    static public function setSession($login, $droit){
        session_name("AppliGestion");
        $_SESSION['authenticated'] = true;
        $_SESSION['token_uncrypted'] = uniqid();
        $_SESSION['token'] = Config::hashPassword($_SESSION['token_uncrypted']);
        $_SESSION['login'] = $login;
        $_SESSION['droit'] = $droit;
    }
    
    static public function testSession(){
        if (!(isset($_SESSION['token']) && Config::hashPassword($_SESSION['token_uncrypted']) == $_SESSION['token'])){
            return false;
        }return true;
    }
}
