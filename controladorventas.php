<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/ventas.php");

$opcion           = $_POST["fEnviar"];
$idVentas        = $_POST["fIdVentas"];
$cantidadVentas    = $_POST["fCantidadVentas"];
$idClienteVenta     = $_POST["fIdClienteVenta"];

$cantidadVentas = htmlspecialchars($cantidadVentas);
$idClienteVenta = htmlspecialchars($idClienteVenta);


$objetoventas = new ventas($conexion, $idVentas, $cantidadVentas, $idClienteVenta);

switch($opcion){
        case 'Ingresar';
        $objetoventas->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetoventas-> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetoventas->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formularioventas.php?msj=$mensaje");
?>