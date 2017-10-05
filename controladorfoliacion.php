<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/foliacion.php");

$opcion           = $_POST["fEnviar"];
$idFoliacion        = $_POST["fIdFoliacion"];
$cantidadHojas    = $_POST["fCantidadHojas"];
$areaHoja  = $_POST["fAreaHoja"];
$idArbol     = $_POST["fIdArbol"];

$cantidadHojas = htmlspecialchars($cantidadHojas);
$areaHoja = htmlspecialchars($areaHoja);
$idArbol = htmlspecialchars($idArbol);


$objetofoliacion = new foliacion($conexion, $idFoliacion, $cantidadHojas, $areaHoja, $idArbol);

switch($opcion){
        case 'Ingresar';
        $objetofoliacion->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetofoliacion-> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetofoliacion->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formulariofoliacion.php?msj=$mensaje");
?>