<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/auditoria.php");

$opcion           = $_POST["fEnviar"];
$idAuditoria        = $_POST["fIdAuditoria"];
$fechaAuditoria    = $_POST["fFechaAuditoria"];
$descripcionAuditoria  = $_POST["fDescripcionAuditoria"];
$idUsuarioAuditoria     = $_POST["fIdUsuarioAuditoria"];

$fechaAuditoria = htmlspecialchars($fechaAuditoria);
$descripcionAuditoria = htmlspecialchars($descripcionAuditoria);
$idUsuarioAuditoria = htmlspecialchars($idUsuarioAuditoria);


$objetoauditoria = new auditoria($conexion, $idAuditoria, $fechaAuditoria, $descripcionAuditoria, $idUsuarioAuditoria);

switch($opcion){
        case 'Ingresar';
        $objetoauditoria->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetoauditoria-> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetoauditoria->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formularioauditoria.php?msj=$mensaje");
?>
