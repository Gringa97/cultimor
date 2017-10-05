<?php
class Usuarios{
    
    private $_conexion;
    private $_idUsuario;
    private $_nombreUsuario;
    private $_correoUsuario;
    private $_claveUsuario;
    private $_fechaRegistro;
    private $_fechaUltimaClave;
    private $_idRolUsuario;
    private $_paginacion = 10;
    
    function __construct($conexion, $idUsuario, $nombreUsuario, $correoUsuario, $claveUsuario, $fechaRegistro, $fechaUltimaClave, $idRolUsuario){
        $this->_conexion = $conexion;
        $this->_idUsuario = $idUsuario;
        $this->_nombreUsuario = $nombreUsuario;
        $this->_correoUsuario = $correoUsuario;
        $this->_claveUsuario = $claveUsuario;
        $this->_fechaRegistro = $fechaRegistro;
        $this->_fechaUltimaClave = $fechaUltimaClave;
        $this->_idRolUsuario = $idRolUsuario;
   
    }
function __get($k){
    return $this->$k;
}

function __set($k,$v){

    $this->$k =$v;
}

function Ingresar(){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO usuario (idUsuario,nombreUsuario,correoUsuario,claveUsuario,fechaRegistro,fechaUltimaClave,idRolUsuario)VALUES (NULL,'$this->_nombreUsuario','$this->_correoUsuario', '".hash('sha256', $this->_claveUsuario)."','$this->_fechaRegistro','$this->_fechaUltimaClave','$this->_idRolUsuario')")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    $modificacion = mysqli_query($this->_conexion,"UPDATE usuario SET nombreUsuario='$this->_nombreUsuario',correoUsuario='$this->_correoUsuario',claveUsuario='".hash('sha256', $this->_claveUsuario)."',fechaRegistro='$this->_fechaRegistro',fechaUltimaClave='$this->_fechaUltimaClave',idRolUsuario='$this->_idRolUsuario' WHERE idUsuario='$this->_idUsuario'")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM usuario WHERE idUsuario=$this->_idUsuario")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return  $eliminacion ;
    
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idUsuario)/$this->_paginacion) AS cantidad FROM usuario") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT * FROM usuario ORDER BY idUsuario") or die (mysqli_error ($this->_conexion));        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $listado = mysqli_query($this->_conexion,"SELECT * FROM usuario ORDER BY idUsuario LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        
    }
    return $listado;
}
}
?>



