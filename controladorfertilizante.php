<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/fertilizante.php");

$opcion           = $_POST["fEnviar"];
$idFertilizante        = $_POST["fIdFertilizante"];
$nombreFertilizante  = $_POST["fNombreFertilizante"];

$nombreFertilizante = htmlspecialchars($nombreFertilizante);


$objetofertilizante= new fertilizante($conexion, $idFertilizante,$nombreFertilizante);

switch($opcion){
        case 'Ingresar';
        $objetofertilizante->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetofertilizante-> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetofertilizante->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formulariofertilizante.php?msj=$mensaje");
?>