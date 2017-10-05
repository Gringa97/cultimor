<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/ataques.php");

$opcion           = $_POST["fEnviar"];
$idAtaques        = $_POST["fIdAtaques"];
$fechaAtaque    = $_POST["fFechaAtaque"];
$porcentajeInfectasion    = $_POST["fPorcentajeInfectasion"];
$idArbolAtaque     = $_POST["fIdArbolAtaque"];
$idEnfermedadAtaque    = $_POST["fIdEnfermedadAtaque"];

$fechaAtaque = htmlspecialchars($fechaAtaque);
$porcentajeInfectasion = htmlspecialchars($porcentajeInfectasion);
$idArbolAtaque = htmlspecialchars($idArbolAtaque);
$idEnfermedadAtaque = htmlspecialchars($idEnfermedadAtaque);


$objetoataques = new ataques($conexion, $idAtaques, $fechaAtaque, $porcentajeInfectasion, $idArbolAtaque,  $idEnfermedadAtaque);

switch($opcion){
        case 'Ingresar';
        $objetoataques->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetoataques-> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetoataques->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formularioataques.php?msj=$mensaje");
?>
