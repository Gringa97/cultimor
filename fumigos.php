<?php
class Fumigos{
    
    private $_conexion;
    private $_idFumigos;
    private $_descripcionFumigos;
    private $_paginacion = 10;
    
    function __construct($conexion, $idFumigos, $descripcionFumigos){
        $this->_conexion = $conexion;
        $this->_idFumigos = $idFumigos;
        $this->_descripcionFumigos = $descripcionFumigos;
   
    }
function __get($k){
    return $this->$k;
}

function __set($k,$v){

    $this->$k =$v;
}

function Ingresar(){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO fumigos (idFumigos,descripcionFumigos)VALUES (NULL,'$this->_descripcionFumigos')")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    $modificacion = mysqli_query($this->_conexion,"UPDATE fumigos SET descripcionFumigos='$this->_descripcionFumigos' WHERE idFumigos='$this->_idFumigos'")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM fumigos WHERE idFumigos=$this->_idFumigos")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return  $eliminacion ;
    
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idFumigos)/$this->_paginacion) AS cantidad FROM fumigos") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT * FROM fumigos ORDER BY idFumigos") or die (mysqli_error ($this->_conexion));        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $listado = mysqli_query($this->_conexion,"SELECT * FROM fumigos ORDER BY idFumigos LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        
    }
    return $listado;
}
}
?>