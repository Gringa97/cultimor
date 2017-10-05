<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/suelo.php");

$opcion           = $_POST["fEnviar"];
$idSuelo        = $_POST["fIdSuelo"];
$nombreSuelo  = $_POST["fNombreSuelo"];

$nombreSuelo = htmlspecialchars($nombreSuelo);


$objetosuelo= new suelo($conexion, $idSuelo,$nombreSuelo);

switch($opcion){
        case 'Ingresar';
        $objetosuelo->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetosuelo-> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetosuelo->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formulariosuelo.php?msj=$mensaje");
?>