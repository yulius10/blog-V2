<?php
class conexion{
    private $hostname = 'localhost';
    private $database = 'blog';
    private $username = 'root';
    private $password = '';
    
    public function  __construct(){
    }
    
    public function getServidor(){
        return $this->hostname;
    }

    public function getDatabase(){
        return $this->database;
    }

    public function getUsuario(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function conectarServidor(){
        if($link=mysqli_connect($this->hostname,$this->username,$this->password,$this->database)){
            return $link;
        }
        else{
            return "";
        }
    }

    public function conectarBaseDatos($link){
        mysqli_select_db($link,$this->database);
    }

    public function cerrarConexion($link){
        mysqli_close($link);
    }

    public function liberarResultado($sql){
        mysqli_free_result($sql);
    }

    public function num_rows($sql){
        mysqli_num_rows($sql);
    }

}
?>