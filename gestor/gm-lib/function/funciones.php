<?php
class funciones{

    public function  __construct(){
    }

    public function conectar(){
        require_once("gm-lib/db/conexion.php");
        $conexion = new conexion();
        $link=$conexion->conectarServidor();
        $conexion->conectarBaseDatos($link);
        return $link;
    }

    public function conectarA(){
        require_once("../gm-lib/db/conexion.php");
        $conexion = new conexion();
        $link=$conexion->conectarServidor();
        $conexion->conectarBaseDatos($link);
        return $link;
    }

    public function desconectar($link){
        require_once("gm-lib/db/conexion.php");
        $conexion = new conexion();
        $conexion->cerrarConexion($link);
    }

    public function desconectarA($link){
        require_once("../gm-lib/db/conexion.php");
        $conexion = new conexion();
        $conexion->cerrarConexion($link);
    }

    public function insertar($tabla,$columnas,$valores,$link){
        $sql = "insert into $tabla ($columnas) values($valores)";
        
        $resulto=mysqli_query($link,$sql);
        if($resulto){
            //$reg = mysqli_insert_id($link);
            $this->auditoria("3",$sql,$tabla,"0",$link);
            return "1";
        }
        else{
            return "0";
        }
    }

    public function consultarMax($tabla,$columna,$nombre,$link){
        $sql = "select MAX($columna) as $nombre from $tabla where reg_eli=0";
        if($resultado = mysqli_query($link,$sql)){
            $num = mysqli_num_rows($resultado);
            if($num > 0){
                $arreglo = mysqli_fetch_array($resultado);
                $reg = $arreglo[$nombre];
                $this->auditoria("1",$sql,$tabla,$reg,$link);
                return $reg;
            }
            else{
                return "0";
            }
        }
    }

    public function editar($tabla,$colum,$where,$link){
        $sql = "update $tabla set $colum where $where";
        $resulto = mysqli_query($link,$sql);
        if($resulto){
            $reg = 0;
            $this->auditoria("2",$sql,$tabla,$reg,$link);
            return "1";
        }
        else{
            return "0";
        }
    }

    public function consultar($tabla,$columnas,$where,$order,$link){
        $sql = "select $columnas from $tabla where reg_eli=0 $where $order";
        if($resultado = mysqli_query($link,$sql)){
            $num = mysqli_num_rows($resultado);
            if($num > 0){
                $arreglo=mysqli_fetch_array($resultado);
                $reg=$arreglo["cod_usu"];
                $this->auditoria("1",$sql,$tabla,$reg,$link);
                return $reg;
            }
            else{
                return "0";
            }
        }
        else{
            echo "error:".mysqli_error($link);
        }
    }

    public function consultarRegistro($tabla,$columnas,$where,$order,$link){
        $sql = "select $columnas from $tabla where reg_eli=0 $where $order";
        if($resultado = mysqli_query($link,$sql)){
            $num = mysqli_num_rows($resultado);
            if($num > 0){
                //$arreglo=mysqli_fetch_array($resultado);
                $this->auditoria("1",$sql,$tabla,"0",$link);
                return $resultado;
            }
            else{
                return "0";
            }
        }
        else{
            echo "error:".mysqli_error($link);
        }
    }

    public function auditoria($transaccion,$sql,$tabla,$reg,$link){
        $fecha=date("Y-m-d H:i:s");
        $aud_cliente=$this->auditoria_cliente();
        $sql='INSERT INTO auditoria(tra_aud,sql_aud,tab_aud,reg_afe_aud,cli_aud,fec_cre) VALUES ("'.$transaccion.'","'.$sql.'","'.$tabla.'","'.$reg.'","'.$aud_cliente.'","'.$fecha.'")';
        mysqli_query($link,$sql);
    }

    public function auditoria_cliente() {
        $ip_cliente = $_SERVER['REMOTE_ADDR'];
        $idi_cliente = $user_language=$this->getUserLanguage();
        $info=$this->detect();
        $sistemaope = "Sistema operativo: ".$info["os"];
        $navegador = "Navegador: ".$info["browser"];
        $informacion_total =$info['info_total'];
        return $ip_cliente."-@@-".$idi_cliente."-@@-".$sistemaope."-@@-".$navegador."-@@-".$informacion_total;
    }

    function getUserLanguage() {
        $idioma =substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
        return $idioma;
    }

    public function detect(){
        $browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME");
        $os=array("WIN","MAC","LINUX");
        # definimos unos valores por defecto para el navegador y el sistema operativo
        $info['browser'] = "OTHER";
        $info['os'] = "OTHER";
        # buscamos el navegador con su sistema operativo
        foreach($browser as $parent){
            $s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
            $f = $s + strlen($parent);
            $version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
            $version = preg_replace('/[^0-9,.]/','',$version);
            if ($s){
                $info['browser'] = $parent;
                $info['version'] = $version;
            }
        }
        # obtenemos el sistema operativo
        foreach($os as $val){
            if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false){
                $info['os'] = $val;
            }
        }
        $info['info_total']=$_SERVER['HTTP_USER_AGENT'];
        # devolvemos el array de valores
        return $info;
    }

    public function encode_this_get($string){
        $control = "1azsx1"; //defino la llave para encriptar la cadena, cambiarla por la que deseamos usar
        $string = $control.$string.$control; //concateno la llave para encriptar la cadena
        $string = base64_encode($string);//codifico la cadena
        $arr1 = str_split($string);
        $reversed = array_reverse($arr1);
        $cadenamejorada = implode($reversed);
        $string = $this->combinarcadenaadelante(ltrim($cadenamejorada));
        return($string);
    }

    public function encode_this_get_correo($string) {
        $control = "1azsx1"; //defino la llave para encriptar la cadena, cambiarla por la que deseamos usar
        $string = $control.$string.$control; //concateno la llave para encriptar la cadena
        $string = base64_encode($string);//codifico la cadena
        $arr1 = str_split($string);
        $reversed = array_reverse($arr1);
        $cadenamejorada = implode($reversed);
        $string = $this->combinarcadenaadelante(ltrim($cadenamejorada));
        return($string);
    }

    public function decode_get2_base($string){
        $cadena222 = $this->combinarcadenaatras(ltrim($string));
        $arr1 = str_split($cadena222);
        $reversed = array_reverse($arr1);
        $string = implode($reversed);
        $string = base64_decode($string); //decodifico la cadena
        $control = "1azsx1"; //defino la llave con la que fue encriptada la cadena,, cambiarla por la que deseamos usar
        $string = str_replace($control, "", "$string"); //quito la llave de la cadena
        return($string);
    }

    public function decode_get2_get($string){
        $cadena222 = $this->combinarcadenaatras(ltrim($string));
        $arr1 = str_split($cadena222);
        $reversed = array_reverse($arr1);
        $string = implode($reversed);
        $string = base64_decode($string); //decodifico la cadena
        $control = "1azsx1"; //defino la llave con la que fue encriptada la cadena,, cambiarla por la que deseamos usar
        $string = str_replace($control, "", "$string"); //quito la llave de la cadena
        //procedo a dejar cada variable en el $_GET
        $cad_get = explode("&",$string); //separo la url por &
        foreach($cad_get as $value){
            $val_get = explode("=",$value); //asigno los valosres al GET
            $_REQUEST[$val_get[0]]=$val_get[1];
        }
    }

    public function decode_get2_get_correo($string){
        $cadena222 = $this->combinarcadenaatras(ltrim($string));
        $arr1 = split($cadena222);
        $reversed = array_reverse($arr1);
        $string = implode($reversed);
        $string = base64_decode($string); //decodifico la cadena
        $control = "1azsx1"; //defino la llave con la que fue encriptada la cadena,, cambiarla por la que deseamos usar
        $string = str_replace($control, "", "$string"); //quito la llave de la cadena
        //procedo a dejar cada variable en el $_GET
        $cad_get = split("[&]",$string); //separo la url por &
        foreach($cad_get as $value){
            $val_get = split("[=]",$value); //asigno los valosres al GET
            $_REQUEST[$val_get[0]]=utf8_decode($val_get[1]);
        }
    }

    public function combinarcadenaatras($cadena){
        $cadena=str_replace("1$$-","=",$cadena);
        $cadena=str_replace("A","@",$cadena);
        $cadena=str_replace("a","A",$cadena);
        $cadena=str_replace("@","a",$cadena);
        $cadena=str_replace("B","@",$cadena);
        $cadena=str_replace("b","B",$cadena);
        $cadena=str_replace("@","b",$cadena);
        $cadena=str_replace("C","@",$cadena);
        $cadena=str_replace("c","C",$cadena);
        $cadena=str_replace("@","c",$cadena);
        $cadena=str_replace("D","@",$cadena);
        $cadena=str_replace("d","D",$cadena);
        $cadena=str_replace("@","d",$cadena);
        $cadena=str_replace("E","@",$cadena);
        $cadena=str_replace("e","E",$cadena);
        $cadena=str_replace("@","e",$cadena);
        $cadena=str_replace("F","@",$cadena);
        $cadena=str_replace("f","F",$cadena);
        $cadena=str_replace("@","f",$cadena);
        $cadena=str_replace("G","@",$cadena);
        $cadena=str_replace("g","G",$cadena);
        $cadena=str_replace("@","g",$cadena);
        $cadena=str_replace("H","@",$cadena);
        $cadena=str_replace("h","H",$cadena);
        $cadena=str_replace("@","h",$cadena);
        $cadena=str_replace("I","@",$cadena);
        $cadena=str_replace("i","I",$cadena);
        $cadena=str_replace("@","i",$cadena);
        $cadena=str_replace("J","@",$cadena);
        $cadena=str_replace("j","J",$cadena);
        $cadena=str_replace("@","j",$cadena);
        $cadena=str_replace("K","@",$cadena);
        $cadena=str_replace("k","K",$cadena);
        $cadena=str_replace("@","k",$cadena);
        $cadena=str_replace("L","@",$cadena);
        $cadena=str_replace("l","L",$cadena);
        $cadena=str_replace("@","l",$cadena);
        $cadena=str_replace("M","@",$cadena);
        $cadena=str_replace("m","M",$cadena);
        $cadena=str_replace("@","m",$cadena);
        $cadena=str_replace("N","@",$cadena);
        $cadena=str_replace("n","N",$cadena);
        $cadena=str_replace("@","n",$cadena);
        $cadena=str_replace("O","@",$cadena);
        $cadena=str_replace("o","O",$cadena);
        $cadena=str_replace("@","o",$cadena);
        $cadena=str_replace("P","@",$cadena);
        $cadena=str_replace("p","P",$cadena);
        $cadena=str_replace("@","p",$cadena);
        $cadena=str_replace("Q","@",$cadena);
        $cadena=str_replace("q","Q",$cadena);
        $cadena=str_replace("@","q",$cadena);
        $cadena=str_replace("R","@",$cadena);
        $cadena=str_replace("r","R",$cadena);
        $cadena=str_replace("@","r",$cadena);
        $cadena=str_replace("S","@",$cadena);
        $cadena=str_replace("s","S",$cadena);
        $cadena=str_replace("@","s",$cadena);
        $cadena=str_replace("T","@",$cadena);
        $cadena=str_replace("t","T",$cadena);
        $cadena=str_replace("@","t",$cadena);
        $cadena=str_replace("U","@",$cadena);
        $cadena=str_replace("u","U",$cadena);
        $cadena=str_replace("@","u",$cadena);
        $cadena=str_replace("V","@",$cadena);
        $cadena=str_replace("v","V",$cadena);
        $cadena=str_replace("@","v",$cadena);
        $cadena=str_replace("W","@",$cadena);
        $cadena=str_replace("w","W",$cadena);
        $cadena=str_replace("@","w",$cadena);
        $cadena=str_replace("X","@",$cadena);
        $cadena=str_replace("x","X",$cadena);
        $cadena=str_replace("@","x",$cadena);
        $cadena=str_replace("Y","@",$cadena);
        $cadena=str_replace("y","Y",$cadena);
        $cadena=str_replace("@","y",$cadena);
        $cadena=str_replace("Z","@",$cadena);
        $cadena=str_replace("z","Z",$cadena);
        $cadena=str_replace("@","z",$cadena);
        return  $cadena;
    }

    public function combinarcadenaadelante($cadena){
        $cadena=str_replace("A","@",$cadena);
        $cadena=str_replace("a","A",$cadena);
        $cadena=str_replace("@","a",$cadena);
        $cadena=str_replace("B","@",$cadena);
        $cadena=str_replace("b","B",$cadena);
        $cadena=str_replace("@","b",$cadena);
        $cadena=str_replace("C","@",$cadena);
        $cadena=str_replace("c","C",$cadena);
        $cadena=str_replace("@","c",$cadena);
        $cadena=str_replace("D","@",$cadena);
        $cadena=str_replace("d","D",$cadena);
        $cadena=str_replace("@","d",$cadena);
        $cadena=str_replace("E","@",$cadena);
        $cadena=str_replace("e","E",$cadena);
        $cadena=str_replace("@","e",$cadena);
        $cadena=str_replace("F","@",$cadena);
        $cadena=str_replace("f","F",$cadena);
        $cadena=str_replace("@","f",$cadena);
        $cadena=str_replace("G","@",$cadena);
        $cadena=str_replace("g","G",$cadena);
        $cadena=str_replace("@","g",$cadena);
        $cadena=str_replace("H","@",$cadena);
        $cadena=str_replace("h","H",$cadena);
        $cadena=str_replace("@","h",$cadena);
        $cadena=str_replace("I","@",$cadena);
        $cadena=str_replace("i","I",$cadena);
        $cadena=str_replace("@","i",$cadena);
        $cadena=str_replace("J","@",$cadena);
        $cadena=str_replace("j","J",$cadena);
        $cadena=str_replace("@","j",$cadena);
        $cadena=str_replace("K","@",$cadena);
        $cadena=str_replace("k","K",$cadena);
        $cadena=str_replace("@","k",$cadena);
        $cadena=str_replace("L","@",$cadena);
        $cadena=str_replace("l","L",$cadena);
        $cadena=str_replace("@","l",$cadena);
        $cadena=str_replace("M","@",$cadena);
        $cadena=str_replace("m","M",$cadena);
        $cadena=str_replace("@","m",$cadena);
        $cadena=str_replace("N","@",$cadena);
        $cadena=str_replace("n","N",$cadena);
        $cadena=str_replace("@","n",$cadena);
        $cadena=str_replace("O","@",$cadena);
        $cadena=str_replace("o","O",$cadena);
        $cadena=str_replace("@","o",$cadena);
        $cadena=str_replace("P","@",$cadena);
        $cadena=str_replace("p","P",$cadena);
        $cadena=str_replace("@","p",$cadena);
        $cadena=str_replace("Q","@",$cadena);
        $cadena=str_replace("q","Q",$cadena);
        $cadena=str_replace("@","q",$cadena);
        $cadena=str_replace("R","@",$cadena);
        $cadena=str_replace("r","R",$cadena);
        $cadena=str_replace("@","r",$cadena);
        $cadena=str_replace("S","@",$cadena);
        $cadena=str_replace("s","S",$cadena);
        $cadena=str_replace("@","s",$cadena);
        $cadena=str_replace("T","@",$cadena);
        $cadena=str_replace("t","T",$cadena);
        $cadena=str_replace("@","t",$cadena);
        $cadena=str_replace("U","@",$cadena);
        $cadena=str_replace("u","U",$cadena);
        $cadena=str_replace("@","u",$cadena);
        $cadena=str_replace("V","@",$cadena);
        $cadena=str_replace("v","V",$cadena);
        $cadena=str_replace("@","v",$cadena);
        $cadena=str_replace("W","@",$cadena);
        $cadena=str_replace("w","W",$cadena);
        $cadena=str_replace("@","w",$cadena);
        $cadena=str_replace("X","@",$cadena);
        $cadena=str_replace("x","X",$cadena);
        $cadena=str_replace("@","x",$cadena);
        $cadena=str_replace("Y","@",$cadena);
        $cadena=str_replace("y","Y",$cadena);
        $cadena=str_replace("@","y",$cadena);
        $cadena=str_replace("Z","@",$cadena);
        $cadena=str_replace("z","Z",$cadena);
        $cadena=str_replace("@","z",$cadena);
        $cadena=str_replace("=","1$$-",$cadena);
        return  $cadena;
    }

    public function coversion_html_utf8_espcial_ca($String){
        $String=str_replace("&#161;","¡",$String);//Signo de exclamación abierta.&iexcl;
        $String=str_replace("&#162;","¢",$String);//Signo de centavo.&cent;
        $String=str_replace("&#163;","£",$String);//Signo de libra esterlina.&pound;
        $String=str_replace("&#164;","¤",$String);//Signo monetario.&curren;
        $String=str_replace("&#165;","¥",$String);//Signo del yen.&yen;
        $String=str_replace("&#166;","¦",$String);//Barra vertical partida.&brvbar;
        $String=str_replace("&#167;","§",$String);//Signo de sección.&sect;
        $String=str_replace("&#168;","¨",$String);//Diéresis.&uml;
        $String=str_replace("&#169;","©",$String);//Signo de derecho de copia.&copy;
        $String=str_replace("&#170;","ª",$String);//Indicador ordinal femenino.&ordf;
        $String=str_replace("&#171;","«",$String);//Signo de comillas francesas de apertura.&laquo;
        $String=str_replace("&#172;","¬",$String);//Signo de negación.&not;
        $String=str_replace("&#173;","",$String);//Guión separador de sílabas.&shy;
        $String=str_replace("&#174;","®",$String);//Signo de marca registrada.&reg;
        $String=str_replace("&#175;","¯",$String);//Macrón.&macr;
        $String=str_replace("&#176;","°",$String);//Signo de grado.&deg;
        $String=str_replace("&#177;","±",$String);//Signo de más-menos.&plusmn;
        $String=str_replace("&#178;","²",$String);//Superíndice dos.&sup2;
        $String=str_replace("&#179;","³",$String);//Superíndice tres.&sup3;
        $String=str_replace("&#180;","´",$String);//Acento agudo.&acute;
        $String=str_replace("&#181;","µ",$String);//Signo de micro.&micro;
        $String=str_replace("&#182;","¶",$String);//Signo de calderón.&para;
        $String=str_replace("&#183;","·",$String);//Punto centrado.&middot;
        $String=str_replace("&#184;","¸",$String);//Cedilla.&cedil;
        $String=str_replace("&#185;","¹",$String);//Superíndice 1.&sup1;
        $String=str_replace("&#186;","º",$String);//Indicador ordinal masculino.&ordm;
        $String=str_replace("&#187;","»",$String);//Signo de comillas francesas de cierre.&raquo;
        $String=str_replace("&#188;","¼",$String);//Fracción vulgar de un cuarto.&frac14;
        $String=str_replace("&#189;","½",$String);//Fracción vulgar de un medio.&frac12;
        $String=str_replace("&#190;","¾",$String);//Fracción vulgar de tres cuartos.&frac34;
        $String=str_replace("&#191;","¿",$String);//Signo de interrogación abierta.&iquest;
        $String=str_replace("&#215;","×",$String);//Signo de multiplicación.&times;
        $String=str_replace("&#247;","÷",$String);//Signo de división.&divide;
        $String=str_replace("&#192;","À",$String);//A mayúscula con acento grave.&Agrave;
        $String=str_replace("&#193;","Á",$String);//A mayúscula con acento agudo.&Aacute;
        $String=str_replace("&#194;","Â",$String);//A mayúscula con circunflejo.&Acirc;
        $String=str_replace("&#195;","Ã",$String);//A mayúscula con tilde.&Atilde;
        $String=str_replace("&#196;","Ä",$String);//A mayúscula con diéresis.&Auml;
        $String=str_replace("&#197;","Å",$String);//A mayúscula con círculo encima.&Aring;
        $String=str_replace("&#198;","Æ",$String);//AE mayúscula.&AElig;
        $String=str_replace("&#199;","Ç",$String);//C mayúscula con cedilla.&Ccedil;
        $String=str_replace("&#200;","È",$String);//E mayúscula con acento grave.&Egrave;
        $String=str_replace("&#201;","É",$String);//E mayúscula con acento agudo.&Eacute;
        $String=str_replace("&#202;","Ê",$String);//E mayúscula con circunflejo.&Ecirc;
        $String=str_replace("&#203;","Ë",$String);//E mayúscula con diéresis.&Euml;
        $String=str_replace("&#204;","Ì",$String);//I mayúscula con acento grave.&Igrave;
        $String=str_replace("&#205;","Í",$String);//I mayúscula con acento agudo.&Iacute;
        $String=str_replace("&#206;","Î",$String);//I mayúscula con circunflejo.&Icirc;
        $String=str_replace("&#207;","Ï",$String);//I mayúscula con diéresis.&Iuml;
        $String=str_replace("&#208;","Ð",$String);//ETH mayúscula.&ETH;
        $String=str_replace("&#209;","Ñ",$String);//N mayúscula con tilde.&Ntilde;
        $String=str_replace("&#210;","Ò",$String);//O mayúscula con acento grave.&Ograve;
        $String=str_replace("&#211;","Ó",$String);//O mayúscula con acento agudo.&Oacute;
        $String=str_replace("&#212;","Ô",$String);//O mayúscula con circunflejo.&Ocirc;
        $String=str_replace("&#213;","Õ",$String);//O mayúscula con tilde.&Otilde;
        $String=str_replace("&#214;","Ö",$String);//O mayúscula con diéresis.&Ouml;
        $String=str_replace("&#216;","Ø",$String);//O mayúscula con barra inclinada.&Oslash;
        $String=str_replace("&#217;","Ù",$String);//U mayúscula con acento grave.&Ugrave;
        $String=str_replace("&#218;","Ú",$String);//U mayúscula con acento agudo.&Uacute;
        $String=str_replace("&#219;","Û",$String);//U mayúscula con circunflejo.&Ucirc;
        $String=str_replace("&#220;","Ü",$String);//U mayúscula con diéresis.&Uuml;
        $String=str_replace("&#221;","Ý",$String);//Y mayúscula con acento agudo.&Yacute;
        $String=str_replace("&#222;","Þ",$String);//Thorn mayúscula.&THORN;
        $String=str_replace("&#223;","ß",$String);//S aguda alemana.&szlig;
        $String=str_replace("&#224;","à",$String);//a minúscula con acento grave.&agrave;
        $String=str_replace("&#225;","á",$String);//a minúscula con acento agudo.&aacute;
        $String=str_replace("&#226;","â",$String);//a minúscula con circunflejo.&acirc;
        $String=str_replace("&#227;","ã",$String);//a minúscula con tilde.&atilde;
        $String=str_replace("&#228;","ä",$String);//a minúscula con diéresis.&auml;
        $String=str_replace("&#229;","å",$String);//a minúscula con círculo encima.&aring;
        $String=str_replace("&#230;","æ",$String);//ae minúscula.&aelig;
        $String=str_replace("&#231;","ç",$String);//c minúscula con cedilla.&ccedil;
        $String=str_replace("&#232;","è",$String);//e minúscula con acento grave.&egrave;
        $String=str_replace("&#233;","é",$String);//e minúscula con acento agudo.&eacute;
        $String=str_replace("&#234;","ê",$String);//e minúscula con circunflejo.&ecirc;
        $String=str_replace("&#235;","ë",$String);//e minúscula con diéresis.&euml;
        $String=str_replace("&#236;","ì",$String);//i minúscula con acento grave.&igrave;
        $String=str_replace("&#237;","í",$String);//i minúscula con acento agudo.&iacute;
        $String=str_replace("&#238;","î",$String);//i minúscula con circunflejo.&icirc;
        $String=str_replace("&#239;","ï",$String);//i minúscula con diéresis.&iuml;
        $String=str_replace("&#240;","ð",$String);//eth minúscula.&eth;
        $String=str_replace("&#241;","ñ",$String);//n minúscula con tilde.&ntilde;
        $String=str_replace("&#242;","ò",$String);//o minúscula con acento grave.&ograve;
        $String=str_replace("&#243;","ó",$String);//o minúscula con acento agudo.&oacute;
        $String=str_replace("&#244;","ô",$String);//o minúscula con circunflejo.&ocirc;
        $String=str_replace("&#245;","õ",$String);//o minúscula con tilde.&otilde;
        $String=str_replace("&#246;","ö",$String);//o minúscula con diéresis.&ouml;
        $String=str_replace("&#248;","ø",$String);//o minúscula con barra inclinada.&oslash;
        $String=str_replace("&#249;","ù",$String);//u minúscula con acento grave.&ugrave;
        $String=str_replace("&#250;","ú",$String);//u minúscula con acento agudo.&uacute;
        $String=str_replace("&#251;","û",$String);//u minúscula con circunflejo.&ucirc;
        $String=str_replace("&#252;","ü",$String);//u minúscula con diéresis.&uuml;
        $String=str_replace("&#253;","ý",$String);//y minúscula con acento agudo.&yacute;
        $String=str_replace("&#254;","þ",$String);//thorn minúscula.&thorn;
        $String=str_replace("&#255;","ÿ",$String);//y minúscula con diéresis.&yuml;
        $String=str_replace("&#338;","Œ",$String);//OE Mayúscula.&OElig;
        $String=str_replace("&#339;","œ",$String);//oe minúscula.&oelig;
        $String=str_replace("&#376;","Ÿ",$String);//Y mayúscula con diéresis.&Yuml;
        $String=str_replace("&#710;","ˆ",$String);//Acento circunflejo.&circ;
        $String=str_replace("&#732;","˜",$String);//Tilde.&tilde;
        $String=str_replace("&#8211;","–",$String);//Guiún corto.&ndash;
        $String=str_replace("&#8212;","—",$String);//Guiún largo.&mdash;
        $String=str_replace("&#8216;","'",$String);//Comilla simple izquierda.&lsquo;
        $String=str_replace("&#8217;","'",$String);//Comilla simple derecha.&rsquo;
        $String=str_replace("&#8218;","‚",$String);//Comilla simple inferior.&sbquo;
        $String=str_replace("&#8221;","\"",$String);//Comillas doble derecha.&rdquo;
        $String=str_replace("&#8222;","\"",$String);//Comillas doble inferior.&bdquo;
        $String=str_replace("&#8224;","†",$String);//Daga.&dagger;
        $String=str_replace("&#8225;","‡",$String);//Daga doble.&Dagger;
        $String=str_replace("&#8230;","…",$String);//Elipsis horizontal.&hellip;
        $String=str_replace("&#8240;","‰",$String);//Signo de por mil.&permil;
        $String=str_replace("&#8249;","‹",$String);//Signo izquierdo de una cita.&lsaquo;
        $String=str_replace("&#8250;","›",$String);//Signo derecho de una cita.&rsaquo;
        $String=str_replace("&#8364;","€",$String);//Euro.&euro;
        $String=str_replace("&#8482;","™",$String);//Marca registrada.&trade;
        $String=str_replace("&#38;","&",$String);//Marca registrada.&trade;
        $String=str_replace("â€","'",$String);//Marca registrada.&trade;
        $String=str_replace("&#34;","'",$String);//comillas dobles
        $String=str_replace("&#8216;","‘",$String);//comilla izquierda - citación
        $String=str_replace("&#8217;","’",$String);//comilla derecha - citación
        $String=str_replace("&#8218;","‚",$String);//comilla de citación - baja
        $String=str_replace("&#8222;","„",$String);//comillas de citación - abajo
        $String=str_replace("&#8220;",'“',$String);//comillas de citación - arriba izquierda
        $String=str_replace("&#8221;",'”',$String);//comillas de citación - arriba derecha
        return($String);
    }

    public function limpiarCadena($valor){
        $valor = str_ireplace("SELECT","",$valor);
        $valor = str_ireplace("COPY","",$valor);
        $valor = str_ireplace("DELETE","",$valor);
        $valor = str_ireplace("DROP","",$valor);
        $valor = str_ireplace("DUMP","",$valor);
        $valor = str_ireplace(" OR ","",$valor);
        $valor = str_ireplace("%","",$valor);
        $valor = str_ireplace("LIKE","",$valor);
        $valor = str_ireplace("--","",$valor);
        $valor = str_ireplace("^","",$valor);
        $valor = str_ireplace("[","",$valor);
        $valor = str_ireplace("]","",$valor);
        $valor = str_ireplace("\\","",$valor);
        $valor = str_ireplace("!","",$valor);
        $valor = str_ireplace("¡","",$valor);
        $valor = str_ireplace("?","",$valor);
        $valor = str_ireplace("=","",$valor);
        $valor = str_ireplace("&","",$valor);
        $valor = str_ireplace("<script","",$valor);
        $valor = str_ireplace("<p>","",$valor);
        $valor = str_ireplace("<html>","",$valor);
        $valor = str_ireplace("<body>","",$valor);
        $valor = str_ireplace("<head>","",$valor);
        $valor = str_ireplace("<div>","",$valor);
        $valor = str_ireplace("<","",$valor);
        $valor = str_ireplace("/>","",$valor);
        $valor = str_ireplace("$","",$valor);
        $valor = str_ireplace("#","",$valor);
        $valor = str_ireplace('"',"",$valor);
        $valor = str_ireplace("'","",$valor);
        $valor = str_ireplace("<?","",$valor);
        $valor = str_ireplace("<?php","",$valor);
        $valor = str_ireplace("?>","",$valor);
        return $valor;
    }

    public function html_conversion_caracter($String){
        $String=str_replace("Á","&Aacute;",$String);
        $String=str_replace("À","&Agrave;",$String);
        $String=str_replace("É","&Eacute;",$String);
        $String=str_replace("È","&Egrave;",$String);
        $String=str_replace("Í","&Iacute;",$String);
        $String=str_replace("Ì","&Igrave;",$String);
        $String=str_replace("Ó","&Oacute;",$String);
        $String=str_replace("Ò","&Ograve;",$String);
        $String=str_replace("Ú","&Uacute;",$String);
        $String=str_replace("Ù","&Ugrave;",$String);
        $String=str_replace("á","&aacute;",$String);
        $String=str_replace("à","&agrave;",$String);
        $String=str_replace("é","&eacute;",$String);
        $String=str_replace("è","&egrave;",$String);
        $String=str_replace("í","&iacute;",$String);
        $String=str_replace("ì","&igrave;",$String);
        $String=str_replace("ó","&oacute;",$String);
        $String=str_replace("ò","&ograve;",$String);
        $String=str_replace("ú","&uacute;",$String);
        $String=str_replace("ù","&ugrave;",$String);
        $String=str_replace("Ä","&Auml;",$String);
        $String=str_replace("Â","&Acirc;",$String);
        $String=str_replace("Ë","&Euml;",$String);
        $String=str_replace("Ê","&Ecirc;",$String);
        $String=str_replace("Ï","&Iuml;",$String);
        $String=str_replace("Ö","&Ouml;",$String);
        $String=str_replace("Ô","&Ocirc;",$String);
        $String=str_replace("Ü","&Uuml;",$String);
        $String=str_replace("Û","&Ucirc;",$String);
        $String=str_replace("ä","&auml;",$String);
        $String=str_replace("â","&acirc;",$String);
        $String=str_replace("ë","&euml;",$String);
        $String=str_replace("ê","&ecirc;",$String);
        $String=str_replace("ï","&iuml;",$String);
        $String=str_replace("î","&icirc;",$String);
        $String=str_replace("ö","&ouml;",$String);
        $String=str_replace("ü","&uuml;",$String);
        $String=str_replace("û","&ucirc;",$String);
        $String=str_replace("å","&aring;",$String);
        $String=str_replace("Ñ","&Ntilde;",$String);
        $String=str_replace("Õ","&Otilde;",$String);
        $String=str_replace("ã","&atilde;",$String);
        $String=str_replace("ñ","&ntilde;",$String);
        $String=str_replace("Ý","&Yacute;",$String);
        $String=str_replace("õ","&otilde;",$String);
        $String=str_replace("ý","&yacute;",$String);
        $String=str_replace("ÿ",'&yuml;',$String);//y minúscula con diéresis;
        $String=str_replace('“','&quot;',$String);//comillas de citación - arriba izquierda;
        $String=str_replace('”','&quot;',$String);//comillas de citación - arriba derecha;
        $String=str_replace('„','&quot;',$String);//comillas de citación - abajo;
        $String=str_replace('"','&quot;',$String);//comillas dobles;
        $String=str_replace("‘", '&quot;',$String);//comilla izquierda - citación
        $String=str_replace("’",'&quot;',$String);//comilla derecha - citación;
        $String=str_replace("«",'&laquo;',$String);//comillas anguladas de apertura;
        $String=str_replace("»",'&raquo;',$String);//comillas anguladas de cierre;
        $String=str_replace("º",'&ordm;',$String);//género masculino - indicador ordinal m.;
        $String=str_replace("©",'&copy;',$String);//signo de derechos de autor - copyright;
        $String=str_replace("ª",'&ordf;',$String);//género feminino - indicador ordinal f.;
        $String=str_replace("¡",'&iexcl;',$String);//signo de apertura de exclamación;
        $String=str_replace(" & ",'&amp;',$String);//signo "&" / ampersand;
        $String=str_replace("<",'&lt;',$String);//signo de menor que;
        $String=str_replace(">",'&gt;',$String);//signo de mayor que;
        $String=str_replace("€",'&euro;',$String);//signo de euro;
        $String=str_replace("ø",'&oslash;',$String);//o barrada minúscula;
        $String=str_replace("÷",'&divide;',$String);//signo de división
        $String=str_replace("æ",'&aelig;',$String);//diptongo ae minúscula (ligadura)
        $String=str_replace("±",'&plusmn;',$String);//signo de más o menos
        $String=str_replace("²",'&sup2;',$String);//superíndice dos - cuadrado
        $String=str_replace("³",'&sup3;',$String);//superíndice tres - cúbico
        $String=str_replace("´",'&acute;',$String);//acento agudo - agudo espaciado
        $String=str_replace("µ",'&micro;',$String);//signo de micro
        $String=str_replace("¶",'&para;',$String);//signo de fin de párrafo
        $String=str_replace("·",'&middot;',$String);//punto medio - coma Georgiana
        $String=str_replace("¸",'&cedil;',$String);//cedilla
        $String=str_replace("¹",'&sup1;',$String);//superíndice uno
        $String=str_replace("¼",'&frac14;',$String);//fracción un cuarto
        $String=str_replace("½",'&frac12;',$String);//fracción medio - mitad
        $String=str_replace("¾",'&frac34;',$String);//fracción tres cuartos
        $String=str_replace("¿",'&iquest;',$String);//signo de interrogación - apertura
        $String=str_replace("¯",'&macr;',$String);//signo de interrogación - apertura
        $String=str_replace("¯",'-',$String);//signo de interrogación - apertura
        $String=str_replace("—",'--',$String);//signo de interrogación - apertura
        return ($String);
    }

    public function correcion_html_utf8($String){
        $String=str_replace("¡","&#161;",$String);//Signo de exclamación abierta.&iexcl;
        $String=str_replace("¢","&#162;",$String);//Signo de centavo.&cent;
        $String=str_replace("£","&#163;",$String);//Signo de libra esterlina.&pound;
        $String=str_replace("¤","&#164;",$String);//Signo monetario.&curren;
        $String=str_replace("¥","&#165;",$String);//Signo del yen.&yen;
        $String=str_replace("¦","&#166;",$String);//Barra vertical partida.&brvbar;
        $String=str_replace("§","&#167;",$String);//Signo de sección.&sect;
        $String=str_replace("¨","&#168;",$String);//Diéresis.&uml;
        $String=str_replace("©","&#169;",$String);//Signo de derecho de copia.&copy;
        $String=str_replace("ª","&#170;",$String);//Indicador ordinal femenino.&ordf;
        $String=str_replace("«","&#171;",$String);//Signo de comillas francesas de apertura.&laquo;
        $String=str_replace("¬","&#172;",$String);//Signo de negación.&not;
        $String=str_replace("","&#173;",$String);//Guión separador de sílabas.&shy;
        $String=str_replace("®","&#174;",$String);//Signo de marca registrada.&reg;
        $String=str_replace("¯","&#175;",$String);//Macrón.&macr;
        $String=str_replace("°","&#176;",$String);//Signo de grado.&deg;
        $String=str_replace("±","&#177;",$String);//Signo de más-menos.&plusmn;
        $String=str_replace("²","&#178;",$String);//Superíndice dos.&sup2;
        $String=str_replace("³","&#179;",$String);//Superíndice tres.&sup3;
        $String=str_replace("´","&#180;",$String);//Acento agudo.&acute;
        $String=str_replace("µ","&#181;",$String);//Signo de micro.&micro;
        $String=str_replace("¶","&#182;",$String);//Signo de calderón.&para;
        $String=str_replace("·","&#183;",$String);//Punto centrado.&middot;
        $String=str_replace("¸","&#184;",$String);//Cedilla.&cedil;
        $String=str_replace("¹","&#185;",$String);//Superíndice 1.&sup1;
        $String=str_replace("º","&#186;",$String);//Indicador ordinal masculino.&ordm;
        $String=str_replace("»","&#187;",$String);//Signo de comillas francesas de cierre.&raquo;
        $String=str_replace("¼","&#188;",$String);//Fracción vulgar de un cuarto.&frac14;
        $String=str_replace("½","&#189;",$String);//Fracción vulgar de un medio.&frac12;
        $String=str_replace("¾","&#190;",$String);//Fracción vulgar de tres cuartos.&frac34;
        $String=str_replace("¿","&#191;",$String);//Signo de interrogación abierta.&iquest;
        $String=str_replace("×","&#215;",$String);//Signo de multiplicación.&times;
        $String=str_replace("÷","&#247;",$String);//Signo de división.&divide;
        $String=str_replace("À","&#192;",$String);//A mayúscula con acento grave.&Agrave;
        $String=str_replace("Á","&#193;",$String);//A mayúscula con acento agudo.&Aacute;
        $String=str_replace("Â","&#194;",$String);//A mayúscula con circunflejo.&Acirc;
        $String=str_replace("Ã","&#195;",$String);//A mayúscula con tilde.&Atilde;
        $String=str_replace("Ä","&#196;",$String);//A mayúscula con diéresis.&Auml;
        $String=str_replace("Å","&#197;",$String);//A mayúscula con círculo encima.&Aring;
        $String=str_replace("Æ","&#198;",$String);//AE mayúscula.&AElig;
        $String=str_replace("Ç","&#199;",$String);//C mayúscula con cedilla.&Ccedil;
        $String=str_replace("È","&#200;",$String);//E mayúscula con acento grave.&Egrave;
        $String=str_replace("É","&#201;",$String);//E mayúscula con acento agudo.&Eacute;
        $String=str_replace("Ê","&#202;",$String);//E mayúscula con circunflejo.&Ecirc;
        $String=str_replace("Ë","&#203;",$String);//E mayúscula con diéresis.&Euml;
        $String=str_replace("Ì","&#204;",$String);//I mayúscula con acento grave.&Igrave;
        $String=str_replace("Í","&#205;",$String);//I mayúscula con acento agudo.&Iacute;
        $String=str_replace("Î","&#206;",$String);//I mayúscula con circunflejo.&Icirc;
        $String=str_replace("Ï","&#207;",$String);//I mayúscula con diéresis.&Iuml;
        $String=str_replace("Ð","&#208;",$String);//ETH mayúscula.&ETH;
        $String=str_replace("Ñ","&#209;",$String);//N mayúscula con tilde.&Ntilde;
        $String=str_replace("Ò","&#210;",$String);//O mayúscula con acento grave.&Ograve;
        $String=str_replace("Ó","&#211;",$String);//O mayúscula con acento agudo.&Oacute;
        $String=str_replace("Ô","&#212;",$String);//O mayúscula con circunflejo.&Ocirc;
        $String=str_replace("Õ","&#213;",$String);//O mayúscula con tilde.&Otilde;
        $String=str_replace("Ö","&#214;",$String);//O mayúscula con diéresis.&Ouml;
        $String=str_replace("Ø","&#216;",$String);//O mayúscula con barra inclinada.&Oslash;
        $String=str_replace("Ù","&#217;",$String);//U mayúscula con acento grave.&Ugrave;
        $String=str_replace("Ú","&#218;",$String);//U mayúscula con acento agudo.&Uacute;
        $String=str_replace("Û","&#219;",$String);//U mayúscula con circunflejo.&Ucirc;
        $String=str_replace("Ü","&#220;",$String);//U mayúscula con diéresis.&Uuml;
        $String=str_replace("Ý","&#221;",$String);//Y mayúscula con acento agudo.&Yacute;
        $String=str_replace("Þ","&#222;",$String);//Thorn mayúscula.&THORN;
        $String=str_replace("ß","&#223;",$String);//S aguda alemana.&szlig;
        $String=str_replace("à","&#224;",$String);//a minúscula con acento grave.&agrave;
        $String=str_replace("á","&#225;",$String);//a minúscula con acento agudo.&aacute;
        $String=str_replace("â","&#226;",$String);//a minúscula con circunflejo.&acirc;
        $String=str_replace("ã","&#227;",$String);//a minúscula con tilde.&atilde;
        $String=str_replace("ä","&#228;",$String);//a minúscula con diéresis.&auml;
        $String=str_replace("å","&#229;",$String);//a minúscula con círculo encima.&aring;
        $String=str_replace("æ","&#230;",$String);//ae minúscula.&aelig;
        $String=str_replace("ç","&#231;",$String);//c minúscula con cedilla.&ccedil;
        $String=str_replace("è","&#232;",$String);//e minúscula con acento grave.&egrave;
        $String=str_replace("é","&#233;",$String);//e minúscula con acento agudo.&eacute;
        $String=str_replace("ê","&#234;",$String);//e minúscula con circunflejo.&ecirc;
        $String=str_replace("ë","&#235;",$String);//e minúscula con diéresis.&euml;
        $String=str_replace("ì","&#236;",$String);//i minúscula con acento grave.&igrave;
        $String=str_replace("í","&#237;",$String);//i minúscula con acento agudo.&iacute;
        $String=str_replace("î","&#238;",$String);//i minúscula con circunflejo.&icirc;
        $String=str_replace("ï","&#239;",$String);//i minúscula con diéresis.&iuml;
        $String=str_replace("ð","&#240;",$String);//eth minúscula.&eth;
        $String=str_replace("ñ","&#241;",$String);//n minúscula con tilde.&ntilde;
        $String=str_replace("ò","&#242;",$String);//o minúscula con acento grave.&ograve;
        $String=str_replace("ó","&#243;",$String);//o minúscula con acento agudo.&oacute;
        $String=str_replace("ô","&#244;",$String);//o minúscula con circunflejo.&ocirc;
        $String=str_replace("õ","&#245;",$String);//o minúscula con tilde.&otilde;
        $String=str_replace("ö","&#246;",$String);//o minúscula con diéresis.&ouml;
        $String=str_replace("ø","&#248;",$String);//o minúscula con barra inclinada.&oslash;
        $String=str_replace("ù","&#249;",$String);//u minúscula con acento grave.&ugrave;
        $String=str_replace("ú","&#250;",$String);//u minúscula con acento agudo.&uacute;
        $String=str_replace("û","&#251;",$String);//u minúscula con circunflejo.&ucirc;
        $String=str_replace("ü","&#252;",$String);//u minúscula con diéresis.&uuml;
        $String=str_replace("ý","&#253;",$String);//y minúscula con acento agudo.&yacute;
        $String=str_replace("þ","&#254;",$String);//thorn minúscula.&thorn;
        $String=str_replace("ÿ","&#255;",$String);//y minúscula con diéresis.&yuml;
        $String=str_replace("Œ","&#338;",$String);//OE Mayúscula.&OElig;
        $String=str_replace("œ","&#339;",$String);//oe minúscula.&oelig;
        $String=str_replace("Ÿ","&#376;",$String);//Y mayúscula con diéresis.&Yuml;
        $String=str_replace("ˆ","&#710;",$String);//Acento circunflejo.&circ;
        $String=str_replace("˜","&#732;",$String);//Tilde.&tilde;
        $String=str_replace("–","&#8211;",$String);//Guiún corto.&ndash;
        $String=str_replace("—","&#8212;",$String);//Guiún largo.&mdash;
        $String=str_replace("'","&#8216;",$String);//Comilla simple izquierda.&lsquo;
        $String=str_replace("'","&#8217;",$String);//Comilla simple derecha.&rsquo;
        $String=str_replace("‚","&#8218;",$String);//Comilla simple inferior.&sbquo;
        $String=str_replace("\"","&#8221;",$String);//Comillas doble derecha.&rdquo;
        $String=str_replace("\"","&#8222;",$String);//Comillas doble inferior.&bdquo;
        $String=str_replace("†","&#8224;",$String);//Daga.&dagger;
        $String=str_replace("‡","&#8225;",$String);//Daga doble.&Dagger;
        $String=str_replace("…","&#8230;",$String);//Elipsis horizontal.&hellip;
        $String=str_replace("‰","&#8240;",$String);//Signo de por mil.&permil;
        $String=str_replace("‹","&#8249;",$String);//Signo izquierdo de una cita.&lsaquo;
        $String=str_replace("›","&#8250;",$String);//Signo derecho de una cita.&rsaquo;
        $String=str_replace("€","&#8364;",$String);//Euro.&euro;
        $String=str_replace("™","&#8482;",$String);//Marca registrada.&trade;
        $String=str_replace(" & ","&#38;",$String);//Marca registrada.&trade;
        $String=str_replace("’","&#8217;",$String);//Marca registrada.&trade;
        $String=str_replace("‘","&#8216;",$String);//Marca registrada.&trade;
        return($String);
    }

    public function coversion_html_utf8($String){
        $String=str_replace("&#161;","¡",$String);//Signo de exclamación abierta.&iexcl;
        $String=str_replace("&#162;","¢",$String);//Signo de centavo.&cent;
        $String=str_replace("&#163;","£",$String);//Signo de libra esterlina.&pound;
        $String=str_replace("&#164;","¤",$String);//Signo monetario.&curren;
        $String=str_replace("&#165;","¥",$String);//Signo del yen.&yen;
        $String=str_replace("&#166;","¦",$String);//Barra vertical partida.&brvbar;
        $String=str_replace("&#167;","§",$String);//Signo de sección.&sect;
        $String=str_replace("&#168;","¨",$String);//Diéresis.&uml;
        $String=str_replace("&#169;","©",$String);//Signo de derecho de copia.&copy;
        $String=str_replace("&#170;","ª",$String);//Indicador ordinal femenino.&ordf;
        $String=str_replace("&#171;","«",$String);//Signo de comillas francesas de apertura.&laquo;
        $String=str_replace("&#172;","¬",$String);//Signo de negación.&not;
        $String=str_replace("&#173;","",$String);//Guión separador de sílabas.&shy;
        $String=str_replace("&#174;","®",$String);//Signo de marca registrada.&reg;
        $String=str_replace("&#175;","¯",$String);//Macrón.&macr;
        $String=str_replace("&#176;","°",$String);//Signo de grado.&deg;
        $String=str_replace("&#177;","±",$String);//Signo de más-menos.&plusmn;
        $String=str_replace("&#178;","²",$String);//Superíndice dos.&sup2;
        $String=str_replace("&#179;","³",$String);//Superíndice tres.&sup3;
        $String=str_replace("&#180;","´",$String);//Acento agudo.&acute;
        $String=str_replace("&#181;","µ",$String);//Signo de micro.&micro;
        $String=str_replace("&#182;","¶",$String);//Signo de calderón.&para;
        $String=str_replace("&#183;","·",$String);//Punto centrado.&middot;
        $String=str_replace("&#184;","¸",$String);//Cedilla.&cedil;
        $String=str_replace("&#185;","¹",$String);//Superíndice 1.&sup1;
        $String=str_replace("&#186;","º",$String);//Indicador ordinal masculino.&ordm;
        $String=str_replace("&#187;","»",$String);//Signo de comillas francesas de cierre.&raquo;
        $String=str_replace("&#188;","¼",$String);//Fracción vulgar de un cuarto.&frac14;
        $String=str_replace("&#189;","½",$String);//Fracción vulgar de un medio.&frac12;
        $String=str_replace("&#190;","¾",$String);//Fracción vulgar de tres cuartos.&frac34;
        $String=str_replace("&#191;","¿",$String);//Signo de interrogación abierta.&iquest;
        $String=str_replace("&#215;","×",$String);//Signo de multiplicación.&times;
        $String=str_replace("&#247;","÷",$String);//Signo de división.&divide;
        $String=str_replace("&#192;","À",$String);//A mayúscula con acento grave.&Agrave;
        $String=str_replace("&#193;","Á",$String);//A mayúscula con acento agudo.&Aacute;
        $String=str_replace("&#194;","Â",$String);//A mayúscula con circunflejo.&Acirc;
        $String=str_replace("&#195;","Ã",$String);//A mayúscula con tilde.&Atilde;
        $String=str_replace("&#196;","Ä",$String);//A mayúscula con diéresis.&Auml;
        $String=str_replace("&#197;","Å",$String);//A mayúscula con círculo encima.&Aring;
        $String=str_replace("&#198;","Æ",$String);//AE mayúscula.&AElig;
        $String=str_replace("&#199;","Ç",$String);//C mayúscula con cedilla.&Ccedil;
        $String=str_replace("&#200;","È",$String);//E mayúscula con acento grave.&Egrave;
        $String=str_replace("&#201;","É",$String);//E mayúscula con acento agudo.&Eacute;
        $String=str_replace("&#202;","Ê",$String);//E mayúscula con circunflejo.&Ecirc;
        $String=str_replace("&#203;","Ë",$String);//E mayúscula con diéresis.&Euml;
        $String=str_replace("&#204;","Ì",$String);//I mayúscula con acento grave.&Igrave;
        $String=str_replace("&#205;","Í",$String);//I mayúscula con acento agudo.&Iacute;
        $String=str_replace("&#206;","Î",$String);//I mayúscula con circunflejo.&Icirc;
        $String=str_replace("&#207;","Ï",$String);//I mayúscula con diéresis.&Iuml;
        $String=str_replace("&#208;","Ð",$String);//ETH mayúscula.&ETH;
        $String=str_replace("&#209;","Ñ",$String);//N mayúscula con tilde.&Ntilde;
        $String=str_replace("&#210;","Ò",$String);//O mayúscula con acento grave.&Ograve;
        $String=str_replace("&#211;","Ó",$String);//O mayúscula con acento agudo.&Oacute;
        $String=str_replace("&#212;","Ô",$String);//O mayúscula con circunflejo.&Ocirc;
        $String=str_replace("&#213;","Õ",$String);//O mayúscula con tilde.&Otilde;
        $String=str_replace("&#214;","Ö",$String);//O mayúscula con diéresis.&Ouml;
        $String=str_replace("&#216;","Ø",$String);//O mayúscula con barra inclinada.&Oslash;
        $String=str_replace("&#217;","Ù",$String);//U mayúscula con acento grave.&Ugrave;
        $String=str_replace("&#218;","Ú",$String);//U mayúscula con acento agudo.&Uacute;
        $String=str_replace("&#219;","Û",$String);//U mayúscula con circunflejo.&Ucirc;
        $String=str_replace("&#220;","Ü",$String);//U mayúscula con diéresis.&Uuml;
        $String=str_replace("&#221;","Ý",$String);//Y mayúscula con acento agudo.&Yacute;
        $String=str_replace("&#222;","Þ",$String);//Thorn mayúscula.&THORN;
        $String=str_replace("&#223;","ß",$String);//S aguda alemana.&szlig;
        $String=str_replace("&#224;","à",$String);//a minúscula con acento grave.&agrave;
        $String=str_replace("&#225;","á",$String);//a minúscula con acento agudo.&aacute;
        $String=str_replace("&#226;","â",$String);//a minúscula con circunflejo.&acirc;
        $String=str_replace("&#227;","ã",$String);//a minúscula con tilde.&atilde;
        $String=str_replace("&#228;","ä",$String);//a minúscula con diéresis.&auml;
        $String=str_replace("&#229;","å",$String);//a minúscula con círculo encima.&aring;
        $String=str_replace("&#230;","æ",$String);//ae minúscula.&aelig;
        $String=str_replace("&#231;","ç",$String);//c minúscula con cedilla.&ccedil;
        $String=str_replace("&#232;","è",$String);//e minúscula con acento grave.&egrave;
        $String=str_replace("&#233;","é",$String);//e minúscula con acento agudo.&eacute;
        $String=str_replace("&#234;","ê",$String);//e minúscula con circunflejo.&ecirc;
        $String=str_replace("&#235;","ë",$String);//e minúscula con diéresis.&euml;
        $String=str_replace("&#236;","ì",$String);//i minúscula con acento grave.&igrave;
        $String=str_replace("&#237;","í",$String);//i minúscula con acento agudo.&iacute;
        $String=str_replace("&#238;","î",$String);//i minúscula con circunflejo.&icirc;
        $String=str_replace("&#239;","ï",$String);//i minúscula con diéresis.&iuml;
        $String=str_replace("&#240;","ð",$String);//eth minúscula.&eth;
        $String=str_replace("&#241;","ñ",$String);//n minúscula con tilde.&ntilde;
        $String=str_replace("&#242;","ò",$String);//o minúscula con acento grave.&ograve;
        $String=str_replace("&#243;","ó",$String);//o minúscula con acento agudo.&oacute;
        $String=str_replace("&#244;","ô",$String);//o minúscula con circunflejo.&ocirc;
        $String=str_replace("&#245;","õ",$String);//o minúscula con tilde.&otilde;
        $String=str_replace("&#246;","ö",$String);//o minúscula con diéresis.&ouml;
        $String=str_replace("&#248;","ø",$String);//o minúscula con barra inclinada.&oslash;
        $String=str_replace("&#249;","ù",$String);//u minúscula con acento grave.&ugrave;
        $String=str_replace("&#250;","ú",$String);//u minúscula con acento agudo.&uacute;
        $String=str_replace("&#251;","û",$String);//u minúscula con circunflejo.&ucirc;
        $String=str_replace("&#252;","ü",$String);//u minúscula con diéresis.&uuml;
        $String=str_replace("&#253;","ý",$String);//y minúscula con acento agudo.&yacute;
        $String=str_replace("&#254;","þ",$String);//thorn minúscula.&thorn;
        $String=str_replace("&#255;","ÿ",$String);//y minúscula con diéresis.&yuml;
        $String=str_replace("&#338;","Œ",$String);//OE Mayúscula.&OElig;
        $String=str_replace("&#339;","œ",$String);//oe minúscula.&oelig;
        $String=str_replace("&#376;","Ÿ",$String);//Y mayúscula con diéresis.&Yuml;
        $String=str_replace("&#710;","ˆ",$String);//Acento circunflejo.&circ;
        $String=str_replace("&#732;","˜",$String);//Tilde.&tilde;
        $String=str_replace("&#8211;","–",$String);//Guiún corto.&ndash;
        $String=str_replace("&#8212;","—",$String);//Guiún largo.&mdash;
        $String=str_replace("&#8216;","'",$String);//Comilla simple izquierda.&lsquo;
        $String=str_replace("&#8217;","'",$String);//Comilla simple derecha.&rsquo;
        $String=str_replace("&#8218;","‚",$String);//Comilla simple inferior.&sbquo;
        $String=str_replace("&#8221;","\"",$String);//Comillas doble derecha.&rdquo;
        $String=str_replace("&#8222;","\"",$String);//Comillas doble inferior.&bdquo;
        $String=str_replace("&#8224;","†",$String);//Daga.&dagger;
        $String=str_replace("&#8225;","‡",$String);//Daga doble.&Dagger;
        $String=str_replace("&#8230;","…",$String);//Elipsis horizontal.&hellip;
        $String=str_replace("&#8240;","‰",$String);//Signo de por mil.&permil;
        $String=str_replace("&#8249;","‹",$String);//Signo izquierdo de una cita.&lsaquo;
        $String=str_replace("&#8250;","›",$String);//Signo derecho de una cita.&rsaquo;
        $String=str_replace("&#8364;","€",$String);//Euro.&euro;
        $String=str_replace("&#8482;","™",$String);//Marca registrada.&trade;
        $String=str_replace("&#38;","&",$String);//Marca registrada.&trade;
        $String=str_replace("&#8217;","’",$String);//Marca registrada.&trade;
        $String=str_replace("&#8216;","‘",$String);//Marca registrada.&trade;
        return($String);
    }

    public function subirArchivo($nombre_certificado, $carpeta){
        if(!empty($nombre_certificado['name'])){
            $nombre_archivo=$nombre_certificado['name'];
            $extension = explode('.', $nombre_archivo);
            $un= uniqid();
            $nombre_archivo=$un.'.'.$extension[1];
            $valida=$this->validarExtension($extension[1]);
            if($valida==0){
                if(!empty($nombre_certificado['name'])){
                    //echo $_SERVER['DOCUMENT_ROOT'].$carpeta.$nombre_archivo;
                    //echo "<br>";
                    //echo $nombre_certificado['name'];
                    if (move_uploaded_file($nombre_certificado['tmp_name'],$_SERVER['DOCUMENT_ROOT'].$carpeta.$nombre_archivo)){
                        echo "Subio.";
                    }
                    else{
                        echo "No Subio.";
                    }
                    //copy($nombre_certificado['tmp_name'],$_SERVER['DOCUMENT_ROOT'].$carpeta.$nombre_archivo);
                }
            }
            return $nombre_archivo;
        }
        else{
            return "";
        }
    }

    public function subirArchivoArray($nombre_certificado, $carpeta){
        $arrayNom = array();
        if(is_array($nombre_certificado['name'])){
            //print_r($nombre_certificado['name']);
            for($i=0;$i<=count($nombre_certificado['name']);$i++){
                if(!empty($nombre_certificado['name'][$i])){
                    $nombre_archivo=$nombre_certificado['name'][$i];
                    $extension = explode('.', $nombre_archivo);
                    $un= uniqid();
                    $nombre_archivo=$un.'.'.$extension[1];
                    $valida=$this->validarExtension($extension[1]);
                    if($valida==0){
                        if(!empty($nombre_certificado['name'][$i])){
                            copy($nombre_certificado['tmp_name'][$i],$carpeta.$nombre_archivo);
                        }
                    }
                    array_push($arrayNom,$nombre_archivo);
                }
            }
        }
        return $arrayNom;
    }

    public function validarExtension($extension){
        $validar=0;
        $extensiones= array ("exe", "bat", "php", "html", "css", "asp", "js", "json");
        if (in_array($extension, $extensiones)){
            $validar=1;
        }
        return $validar;
    }

    public function consultaParametros($tabla,$columna,$where,$link){
        $sql="select $columna from $tabla where $where";

        if($resultado = mysqli_query($link,$sql)){
            $num = mysqli_num_rows($resultado);
            if($num > 0){
                $arreglo=mysqli_fetch_array($resultado);
                $reg=$arreglo[$columna];
                $this->auditoria("1",$sql,$tabla,0,$link);
                return $reg;
            }
            else{
                return "0";
            }
        }
        else{
            echo "error:".mysqli_error($link);
        }
        //return $sql;
    }
}
?>
