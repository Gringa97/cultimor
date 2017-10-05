<?php
class Enfermedad{
    
    private $_conexion;
    private $_idEnfermedad;
    private $_descripcionEnfermedad;
    private $_paginacion = 10;
    
    function __construct($conexion, $idEnfermedad, $descripcionEnfermedad){
        $this->_conexion = $conexion;
        $this->_idEnfermedad = $idEnfermedad;
        $this->_descripcionEnfermedad = $descripcionEnfermedad;
   
    }
function __get($k){
    return $this->$k;
}

function __set($k,$v){

    $this->$k =$v;
}

function Ingresar(){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO enfermedad (idEnfermedad,descripcionEnfermedad)VALUES (NULL,'$this->_descripcionEnfermedad')")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    $modificacion = mysqli_query($this->_conexion,"UPDATE enfermedad SET descripcionEnfermedad='$this->_descripcionEnfermedad' WHERE idEnfermedad='$this->_idEnfermedad'")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM enfermedad WHERE idEnfermedad=$this->_idEnfermedad")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return  $eliminacion ;
    
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idEnfermedad)/$this->_paginacion) AS cantidad FROM enfermedad") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT * FROM enfermedad ORDER BY idEnfermedad") or die (mysqli_error ($this->_conexion));        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $listado = mysqli_query($this->_conexion,"SELECT * FROM enfermedad ORDER BY idEnfermedad LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        
    }
    return $listado;
}
}
?>