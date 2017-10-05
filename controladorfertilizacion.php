<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/fertilizacion.php");

$opcion           = $_POST["fEnviar"];
$idFertilizacion       = $_POST["fIdFertilizacion"];
$fechaFertilizacion    = $_POST["fFechaFertilizacion"];
$cantidadFertilizante    = $_POST["fCantidadFertilizante"];
$idArbolFertilizacion     = $_POST["fIdArbolFertilizacion"];
$idFertilizante    = $_POST["fIdFertilizante"];

$fechaFertilizacion = htmlspecialchars($fechaFertilizacion);
$cantidadFertilizante = htmlspecialchars($cantidadFertilizante);
$idArbolFertilizacion = htmlspecialchars($idArbolFertilizacion);
$idFertilizante = htmlspecialchars($idFertilizante);


$objetofertilizacion = new fertilizacion($conexion, $idFertilizacion, $fechaFertilizacion, $cantidadFertilizante, $idArbolFertilizacion,  $idFertilizante);

switch($opcion){
        case 'Ingresar';
        $objetofertilizacion->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetofertilizacion-> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetofertilizacion->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formulariofertilizacion.php?msj=$mensaje");
?>