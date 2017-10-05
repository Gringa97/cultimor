<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/clientes.php");

$opcion           = $_POST["fEnviar"];
$idClientes        = $_POST["fIdClientes"];
$nombreCliente    = $_POST["fNombreCliente"];
$telefonoCliente    = $_POST["fTelefonoCliente"];
$direccionCliente     = $_POST["fDireccionCliente"];
$fechaRegistro    = $_POST["fFechaRegistro"];

$nombreCliente = htmlspecialchars($nombreCliente);
$telefonoCliente = htmlspecialchars($telefonoCliente);
$direccionCliente = htmlspecialchars($direccionCliente);
$fechaRegistro = htmlspecialchars($fechaRegistro);


$objetoclientes = new clientes($conexion, $idClientes, $nombreCliente, $telefonoCliente, $direccionCliente,  $fechaRegistro);

switch($opcion){
        case 'Ingresar';
        $objetoclientes->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetoclientes-> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetoclientes->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formularioclientes.php?msj=$mensaje");
?>
