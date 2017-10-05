<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/rol.php");

$opcion = $_POST["fEnviar"];
$idRol = $_POST["fIdRol"];
$nombreRol = $_POST["fNombreRol"];
$arbolRol = $_POST["fArbolRol"];
$variedadRol = $_POST["fVariedadRol"];
$sueloRol = $_POST["fSueloRol"];
$enfermedadRol = $_POST["fEnfermedadRol"];
$produccionRol = $_POST["fProduccionRol"];
$ataquesRol = $_POST["fAtaquesRol"];
$clientesRol = $_POST["fClientesRol"];
$ventasRol = $_POST["fVentasRol"];
$tratamientoRol = $_POST["fTratamientoRol"];
$fumigosRol = $_POST["fFumigosRol"];
$foliacionRol = $_POST["fFoliacionRol"];
$floracionRol = $_POST["fFloracionRol"];
$fertilizanteRol = $_POST["fFertilizanteRol"];
$fertilizacionRol = $_POST["fFertilizacionRol"];
$usuarioRol = $_POST["fUsuarioRol"];
$auditoresRol = $_POST["fAuditoresRol"];
$rolRol = $_POST["fRolRol"];


$nombreRol =  htmlspecialchars($nombreRol);
$arbolRol =   htmlspecialchars($arbolRol);
$variedadRol =htmlspecialchars($variedadRol);
$sueloRol =   htmlspecialchars($sueloRol);
$enfermedadRol = htmlspecialchars($enfermedadRol);
$produccionRol = htmlspecialchars($produccionRol);
$ataquesRol =  htmlspecialchars($ataquesRol);
$clientesRol = htmlspecialchars($clientesRol);
$ventasRol =  htmlspecialchars($ventasRol);
$tratamientoRol = htmlspecialchars($tratamientoRol);
$fumigosRol =   htmlspecialchars($fumigosRol);
$foliacionRol = htmlspecialchars($foliacionRol);
$floracionRol = htmlspecialchars($floracionRol);
$fertilizanteRol = htmlspecialchars($fertilizanteRol);
$fertilizacionRol = htmlspecialchars($fertilizacionRol);
$usuarioRol =  htmlspecialchars($usuarioRol);
$auditoresRol = htmlspecialchars($auditoresRol);
$rolRol =       htmlspecialchars($rolRol);


$objetorol = new rol($conexion, $idRol, $nombreRol, $arbolRol, $variedadRol, $sueloRol, $enfermedadRol, $produccionRol, $ataquesRol, $clientesRol, $ventasRol, $tratamientoRol, $fumigosRol, $foliacionRol, $floracionRol, $fertilizanteRol, $fertilizacionRol, $usuarioRol, $auditoresRol, $rolRol);

switch($opcion){
        case 'Ingresar';
        $objetorol->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetorol->modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetorol->eliminar();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formulariorol.php?msj=$mensaje");
?>
