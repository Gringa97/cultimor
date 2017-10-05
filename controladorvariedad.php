<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/variedad.php");

$opcion           = $_POST["fEnviar"];
$idVariedad        = $_POST["fIdVariedad"];
$nombreVariedad  = $_POST["fNombreVariedad"];

$nombreVariedad = htmlspecialchars($nombreVariedad);


$objetovariedad= new variedad($conexion, $idVariedad,$nombreVariedad);

switch($opcion){
        case 'Ingresar';
        $objetovariedad->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetovariedad-> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetovariedad->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formulariovariedad.php?msj=$mensaje");
?>