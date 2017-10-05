<?php
class Tratamiento{
    
    private $_conexion;
    private $_idTratamiento;
    private $_fechaTratamiento;
    private $_descripcionTratamiento;
    private $_idAtaqueTratamiento;
    private $_paginacion = 10;
    
    function __construct($conexion, $idTratamiento, $fechaTratamiento, $descripcionTratamiento, $idAtaqueTratamiento){
        $this->_conexion = $conexion;
        $this->_idTratamiento = $idTratamiento;
        $this->_fechaTratamiento = $fechaTratamiento;
        $this->_descripcionTratamiento = $descripcionTratamiento;
        $this->_idAtaqueTratamiento = $idAtaqueTratamiento;
   
    }
function __get($k){
    return $this->$k;
}

function __set($k,$v){

    $this->$k =$v;
}

function Ingresar(){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO tratamiento (idTratamiento,fechaTratamiento,descripcionTratamiento,idAtaqueTratamiento)VALUES (NULL,'$this->_fechaTratamiento','$this->_descripcionTratamiento','$this->_idAtaqueTratamiento')")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    $modificacion = mysqli_query($this->_conexion,"UPDATE tratamiento SET fechaTratamiento='$this->_fechaTratamiento',descripcionTratamiento='$this->_descripcionTratamiento',idAtaqueTratamiento='$this->_idAtaqueTratamiento' WHERE idTratamiento='$this->_idTratamiento'")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM tratamiento WHERE idTratamiento=$this->_idTratamiento")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return  $eliminacion ;
    
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idTratamiento)/$this->_paginacion) AS cantidad FROM tratamiento") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT * FROM tratamiento ORDER BY idTratamiento") or die (mysqli_error ($this->_conexion));        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $listado = mysqli_query($this->_conexion,"SELECT * FROM tratamiento ORDER BY idTratamiento LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        
    }
    return $listado;
}
}
?>