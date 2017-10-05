<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/floracion.php");

$opcion           = $_POST["fEnviar"];
$idFloracion        = $_POST["fIdFloracion"];
$fechaFloracion    = $_POST["fFechaFloracion"];
$cantidadFlores  = $_POST["fCantidadFlores"];
$idArbolFloracion     = $_POST["fIdArbolFloracion"];

$fechaFloracion = htmlspecialchars($fechaFloracion);
$cantidadFlores = htmlspecialchars($cantidadFlores);
$idArbolFloracion = htmlspecialchars($idArbolFloracion);


$objetofloracion = new floracion($conexion, $idFloracion, $fechaFloracion, $cantidadFlores, $idArbolFloracion);

switch($opcion){
        case 'Ingresar';
        $objetofloracion->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetofloracion-> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetofloracion->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formulariofloracion.php?msj=$mensaje");
?>
