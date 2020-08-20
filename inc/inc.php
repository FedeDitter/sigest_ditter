<?php 
include "conexion.php";
session_start();

//Para verificar que no este logeado
function logeado(){
    if(!isset($_SESSION["logeado"])){
        header("location: ../index.php");
    }
}

//Para verificar que este logeado
function login(){
    if(isset($_SESSION["logeado"])){
        header("location: modulos/inicio.php");
    }
}

function validar_cuil($cuil){
    //Para tomar el ultimo digito del CUIL
    $ultimoDigito= substr($cuil, strlen($cuil)-1);
    $factores = array(5,4,3,2,7,6,5,4,3,2);

    $sumatoria = 0;

    for($i=0; $i < strlen($cuil)-1; $i++){
        $sumatoria += (substr($cuil,$i,1) * $factores[$i]);
    }

    $resto = $sumatoria % 11;
    //La expresion (A)?(B):(C) evalúa a "B" si "A" se evalúa como TRUE y a "C" si "A se evalúa como FALSE
    $digitoVerificador = ($resto != 0) ? 11 - $resto : $resto;

    return ($digitoVerificador == $ultimoDigito);
}
?>