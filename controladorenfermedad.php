<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/enfermedad.php");

$opcion           = $_POST["fEnviar"];
$idEnfermedad        = $_POST["fIdEnfermedad"];
$descripcionEnfermedad  = $_POST["fDescripcionEnfermedad"];

$descripcionEnfermedad = htmlspecialchars($descripcionEnfermedad);


$objetoenfermedad = new enfermedad($conexion, $idEnfermedad,$descripcionEnfermedad);

switch($opcion){
        case 'Ingresar';
        $objetoenfermedad->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetoenfermedad-> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetoenfermedad->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formularioenfermedad.php?msj=$mensaje");
?>