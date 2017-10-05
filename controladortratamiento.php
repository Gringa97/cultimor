<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/tratamiento.php");

$opcion           = $_POST["fEnviar"];
$idTratamiento        = $_POST["fIdTratamiento"];
$fechaTratamiento    = $_POST["fFechaTratamiento"];
$descripcionTratamiento  = $_POST["fDescripcionTratamiento"];
$idAtaqueTratamiento     = $_POST["fIdAtaqueTratamiento"];

$fechaTratamiento = htmlspecialchars($fechaTratamiento);
$descripcionTratamiento = htmlspecialchars($descripcionTratamiento);
$idAtaqueTratamiento = htmlspecialchars($idAtaqueTratamiento);


$objetotratamiento = new tratamiento($conexion, $idTratamiento, $fechaTratamiento, $descripcionTratamiento, $idAtaqueTratamiento);

switch($opcion){
        case 'Ingresar';
        $objetotratamiento->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetotratamiento-> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetotratamiento->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formulariotratamiento.php?msj=$mensaje");
?>