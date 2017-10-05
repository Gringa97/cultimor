<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/usuarios.php");

$opcion           = $_POST["fEnviar"];
$idUsuario        = $_POST["fIdUsuario"];
$nombreUsuario    = $_POST["fNombreUsuario"];
$correoUsuario    = $_POST["fCorreoUsuario"];
$claveUsuario     = $_POST["fClaveUsuario"];
$fechaRegistro    = $_POST["fFechaRegistro"];
$fechaUltimaClave = $_POST["fFechaUltimaClave"];
$idRolUsuario     = $_POST["fIdRolUsuario"];

$nombreUsuario = htmlspecialchars($nombreUsuario);
$correoUsuario = htmlspecialchars($correoUsuario);
$claveUsuario = htmlspecialchars($claveUsuario);
$fechaRegistro = htmlspecialchars($fechaRegistro);
$fechaUltimaClave = htmlspecialchars($fechaUltimaClave);
$idRolUsuario = htmlspecialchars($idRolUsuario);


$objetousuario = new usuarios($conexion, $idUsuario, $nombreUsuario, $correoUsuario, $claveUsuario,  $fechaRegistro, $fechaUltimaClave, $idRolUsuario);

switch($opcion){
        case 'Ingresar';
        $objetousuario->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetousuario-> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetousuario->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formulariousuarios.php?msj=$mensaje");
?>
