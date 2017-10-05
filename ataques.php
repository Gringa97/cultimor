<?php
class Ataques{
    
    private $_conexion;
    private $_idAtaques;
    private $_fechaAtaque;
    private $_porcentajeInfectasion;
    private $_idArbolAtaque;
    private $_idEnfermedadAtaque;
    private $_paginacion = 10;
    
    function __construct($conexion, $idAtaques, $fechaAtaque, $porcentajeInfectasion, $idArbolAtaque, $idEnfermedadAtaque){
        $this->_conexion = $conexion;
        $this->_idAtaques = $idAtaques;
        $this->_fechaAtaque = $fechaAtaque;
        $this->_porcentajeInfectasion = $porcentajeInfectasion;
        $this->_idArbolAtaque = $idArbolAtaque;
        $this->_idEnfermedadAtaque = $idEnfermedadAtaque;
   
    }
function __get($k){
    return $this->$k;
}

function __set($k,$v){

    $this->$k =$v;
}

function Ingresar(){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO ataques (idAtaques,fechaAtaque,porcentajeInfectasion,idArbolAtaque,idEnfermedadAtaque)VALUES (NULL,'$this->_fechaAtaque','$this->_porcentajeInfectasion','$this->_idArbolAtaque','$this->_idEnfermedadAtaque')")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    $modificacion = mysqli_query($this->_conexion,"UPDATE ataques SET fechaAtaque='$this->_fechaAtaque',porcentajeInfectasion='$this->_porcentajeInfectasion',idArbolAtaque='$this->_idArbolAtaque',idEnfermedadAtaque='$this->_idEnfermedadAtaque' WHERE idAtaques='$this->_idAtaques'")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}
    
function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM ataques WHERE idAtaques=$this->_idAtaques")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return  $eliminacion ;
    
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idAtaques)/$this->_paginacion) AS cantidad FROM ataques") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT * FROM ataques ORDER BY idAtaques") or die (mysqli_error ($this->_conexion));        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $listado = mysqli_query($this->_conexion,"SELECT * FROM ataques ORDER BY idAtaques LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        
    }
    return $listado;
}
}
?>



