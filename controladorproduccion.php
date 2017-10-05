<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/produccion.php");

$opcion           = $_POST["fEnviar"];
$idProduccion        = $_POST["fIdProduccion"];
$fechaProduccion    = $_POST["fFechaProduccion"];
$gramosProducidos    = $_POST["fGramosProducidos"];
$gramosDesechados     = $_POST["fGramosDesechados"];
$idArbolProduccion    = $_POST["fIdArbolProduccion"];

$fechaProduccion = htmlspecialchars($fechaProduccion);
$gramosProducidos = htmlspecialchars($gramosProducidos);
$gramosDesechados = htmlspecialchars($gramosDesechados);
$idArbolProduccion = htmlspecialchars($idArbolProduccion);


$objetoproduccion = new produccion($conexion, $idProduccion, $fechaProduccion, $gramosProducidos, $gramosDesechados,  $idArbolProduccion);

switch($opcion){
        case 'Ingresar';
        $objetoproduccion->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetoproduccion-> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetoproduccion->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formularioproduccion.php?msj=$mensaje");
?>