<?php
class Fertilizante{
    
    private $_conexion;
    private $_idFertilizante;
    private $_nombreFertilizante;
    private $_paginacion = 10;
    
    function __construct($conexion, $idFertilizante, $nombreFertilizante){
        $this->_conexion = $conexion;
        $this->_idFertilizante = $idFertilizante;
        $this->_nombreFertilizante = $nombreFertilizante;
   
    }
function __get($k){
    return $this->$k;
}

function __set($k,$v){

    $this->$k =$v;
}

function Ingresar(){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO fertilizante (idFertilizante,nombreFertilizante)VALUES (NULL,'$this->_nombreFertilizante')")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    $modificacion = mysqli_query($this->_conexion,"UPDATE fertilizante SET nombreFertilizante='$this->_nombreFertilizante' WHERE idFertilizante='$this->_idFertilizante'")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM fertilizante WHERE idFertilizante=$this->_idFertilizante")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return  $eliminacion ;
    
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idFertilizante)/$this->_paginacion) AS cantidad FROM fertilizante") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT * FROM fertilizante ORDER BY idFertilizante") or die (mysqli_error ($this->_conexion));        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $listado = mysqli_query($this->_conexion,"SELECT * FROM fertilizante ORDER BY idFertilizante LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        
    }
    return $listado;
}
}
?>