<?php
class Fertilizacion{
    
    private $_conexion;
    private $_idFertilizacion;
    private $_fechaFertilizacion;
    private $_cantidadFertilizante;
    private $_idArbolFertilizacion;
    private $_idFertilizante;
    private $_paginacion = 10;
    
    function __construct($conexion, $idFertilizacion, $fechaFertilizacion, $cantidadFertilizante, $idArbolFertilizacion, $idFertilizante){
        $this->_conexion = $conexion;
        $this->_idFertilizacion = $idFertilizacion;
        $this->_fechaFertilizacion = $fechaFertilizacion;
        $this->_cantidadFertilizante = $cantidadFertilizante;
        $this->_idArbolFertilizacion = $idArbolFertilizacion;
        $this->_idFertilizante = $idFertilizante;
   
    }
function __get($k){
    return $this->$k;
}

function __set($k,$v){

    $this->$k =$v;
}

function Ingresar(){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO fertilizacion (idFertilizacion,fechaFertilizacion,cantidadFertilizante,idArbolFertilizacion,idFertilizante)VALUES (NULL,'$this->_fechaFertilizacion','$this->_cantidadFertilizante','$this->_idArbolFertilizacion','$this->_idFertilizante')")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    $modificacion = mysqli_query($this->_conexion,"UPDATE fertilizacion SET fechaFertilizacion='$this->_fechaFertilizacion',cantidadFertilizante='$this->_cantidadFertilizante',idArbolFertilizacion='$this->_idArbolFertilizacion',idFertilizante='$this->_idFertilizante' WHERE idFertilizacion='$this->_idFertilizacion'")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM fertilizacion WHERE idFertilizacion=$this->_idFertilizacion")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return  $eliminacion ;
    
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idFertilizacion)/$this->_paginacion) AS cantidad FROM fertilizacion") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT * FROM fertilizacion ORDER BY idFertilizacion") or die (mysqli_error ($this->_conexion));        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $listado = mysqli_query($this->_conexion,"SELECT * FROM fertilizacion ORDER BY idFertilizacion LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        
    }
    return $listado;
}
}
?>