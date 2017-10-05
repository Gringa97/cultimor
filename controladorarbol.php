<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/arbol.php");

$opcion =  $_POST["fEnviar"];
$idArbol = $_POST["fIdArbol"];
$alturaArbol = $_POST["fAlturaArbol"];
$fechaSiembraArbol = $_POST["fFechaSiembraArbol"];
$idVariedadArbol = $_POST["fIdVariedadArbol"];
$idSuelo = $_POST["fIdSuelo"];
$gpsArbol = $_POST["fGpsArbol"];

$alturaArbol = htmlspecialchars($alturaArbol);
$fechaSiembraArbol = htmlspecialchars($fechaSiembraArbol);
$idVariedadArbol = htmlspecialchars($idVariedadArbol);
$idSuelo = htmlspecialchars($idSuelo);
$gpsArbol = htmlspecialchars($gpsArbol);


$objetoarbol = new arbol($conexion, $idArbol, $alturaArbol, $fechaSiembraArbol, $idVariedadArbol, $idSuelo, $gpsArbol);

switch($opcion){
        case 'Ingresar';
        $objetoarbol->insertar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetoarbol->modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetoarbol->eliminar();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formularioarbol.php?msj=$mensaje");
?>
