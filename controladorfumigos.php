<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/fumigos.php");

$opcion           = $_POST["fEnviar"];
$idFumigos        = $_POST["fIdFumigos"];
$descripcionFumigos  = $_POST["fDescripcionFumigos"];

$descripcionFumigos = htmlspecialchars($descripcionFumigos);


$objetoFumigos = new fumigos($conexion, $idFumigos,$descripcionFumigos);

switch($opcion){
        case 'Ingresar';
        $objetoFumigos->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetoFumigos-> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetoFumigos->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formulariofumigos.php?msj=$mensaje");
?>