<?php
class Produccion{
    
    private $_conexion;
    private $_idProduccion;
    private $_fechaProduccion;
    private $_gramosProducidos;
    private $_gramosDesechados;
    private $_idArbolProduccion;
    private $_paginacion = 10;
    
    function __construct($conexion, $idProduccion, $fechaProduccion, $gramosProducidos, $gramosDesechados, $idArbolProduccion){
        $this->_conexion = $conexion;
        $this->_idProduccion = $idProduccion;
        $this->_fechaProduccion = $fechaProduccion;
        $this->_gramosProducidos = $gramosProducidos;
        $this->_gramosDesechados = $gramosDesechados;
        $this->_idArbolProduccion = $idArbolProduccion;
   
    }
function __get($k){
    return $this->$k;
}

function __set($k,$v){

    $this->$k =$v;
}

function Ingresar(){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO produccion (idProduccion,fechaProduccion,gramosProducidos,gramosDesechados,idArbolProduccion)VALUES (NULL,'$this->_fechaProduccion','$this->_gramosProducidos','$this->_gramosDesechados','$this->_idArbolProduccion')")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    $modificacion = mysqli_query($this->_conexion,"UPDATE produccion SET fechaProduccion='$this->_fechaProduccion',gramosProducidos='$this->_gramosProducidos',gramosDesechados='$this->_gramosDesechados',idArbolProduccion='$this->_idArbolProduccion' WHERE idProduccion='$this->_idProduccion'")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM produccion WHERE idProduccion=$this->_idProduccion")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return  $eliminacion ;
    
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idProduccion)/$this->_paginacion) AS cantidad FROM produccion") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT * FROM produccion ORDER BY idProduccion") or die (mysqli_error ($this->_conexion));        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $listado = mysqli_query($this->_conexion,"SELECT * FROM produccion ORDER BY idProduccion LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        
    }
    return $listado;
}
}
?>