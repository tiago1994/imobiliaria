<?php
define("URL_BASE", "http://localhost/imobiliaria/");
//define("URL_BASE", "http://www.macanetaweb.com.br/imobiliaria/");
$link = mysqli_connect("localhost", "root", "", "base_imobiliaria");
//$link = mysqli_connect("localhost", "talis560_imobi", "10203040", "talis560_imobiliaria");
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
} 
function FormataData($data){
    if(isset($data)){
        return implode("/", array_reverse(explode("-", substr($data, 0, 10))));
    }else{
        return '';
    }
}

function ReformataData($data){
    if(isset($data)){
        return implode("-",array_reverse(explode("/",$data)));
    }else{
        return '';
    }
}  
function RemoveEspaco($str){
    $str = strtolower(utf8_decode($str)); $i=1;
    $str = strtr($str, utf8_decode('àáâãäåæçèéêëìíîïñòóôõöøùúûýýÿ'), 'aaaaaaaceeeeiiiinoooooouuuyyy');
    $str = preg_replace("/([^a-z0-9])/",'-',utf8_encode($str));
    while($i>0) $str = str_replace('--','-',$str,$i);
    if (substr($str, -1) == '-') $str = substr($str, 0, -1);
    return $str;
}
?>