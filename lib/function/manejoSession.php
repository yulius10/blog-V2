<?php
class manejoSession{
    public function  __construct(){
    }
    public function iniciarSession(){
        session_start();
    }
    public function crearSession($nombre,$valor){
        $_SESSION[$nombre] = $valor;
    }
    public function codificarSession(){
        return session_encode();
    }
    public function decodificarSession($session){
        session_decode($session);
    }
    public function destruirSession(){
        session_destroy();
    }
    public function getSession($nombre){
        return $_SESSION[$nombre];
    }
}
?>