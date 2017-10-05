<?php
class Floracion{
    
    private $_conexion;
    private $_idFloracion;
    private $_fechaFloracion;
    private $_cantidadFlores;
    private $_idArbolFloracion;
    private $_paginacion = 10;
    
    function __construct($conexion, $idFloracion, $fechaFloracion, $cantidadFlores, $idArbolFloracion){
        $this->_conexion = $conexion;
        $this->_idFloracion = $idFloracion;
        $this->_fechaFloracion = $fechaFloracion;
        $this->_cantidadFlores = $cantidadFlores;
        $this->_idArbolFloracion = $idArbolFloracion;
   
    }
function __get($k){
    return $this->$k;
}

function __set($k,$v){

    $this->$k =$v;
}

function Ingresar(){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO floracion (idFloracion,fechaFloracion,cantidadFlores,idArbolFloracion)VALUES (NULL,'$this->_fechaFloracion','$this->_cantidadFlores','$this->_idArbolFloracion')")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    $modificacion = mysqli_query($this->_conexion,"UPDATE floracion SET fechaFloracion='$this->_fechaFloracion',cantidadFlores='$this->_cantidadFlores',idArbolFloracion='$this->_idArbolFloracion' WHERE idFloracion='$this->_idFloracion'")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM floracion WHERE idFloracion=$this->_idFloracion")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return  $eliminacion ;
    
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idFloracion)/$this->_paginacion) AS cantidad FROM floracion") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT * FROM floracion ORDER BY idFloracion") or die (mysqli_error ($this->_conexion));        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $listado = mysqli_query($this->_conexion,"SELECT * FROM floracion ORDER BY idFloracion LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        
    }
    return $listado;
}
}
?>