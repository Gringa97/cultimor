<?php
class Clientes{
    
    private $_conexion;
    private $_idClientes;
    private $_nombreCliente;
    private $_telefonoCliente;
    private $_direccionCliente;
    private $_fechaRegistro;
    private $_paginacion = 10;
    
    function __construct($conexion, $idClientes, $nombreCliente, $telefonoCliente, $direccionCliente, $fechaRegistro){
        $this->_conexion = $conexion;
        $this->_idClientes = $idClientes;
        $this->_nombreCliente = $nombreCliente;
        $this->_telefonoCliente = $telefonoCliente;
        $this->_direccionCliente = $direccionCliente;
        $this->_fechaRegistro = $fechaRegistro;
   
    }
function __get($k){
    return $this->$k;
}

function __set($k,$v){

    $this->$k =$v;
}

function Ingresar(){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO clientes (idClientes,nombreCliente,telefonoCliente,direccionCliente,fechaRegistro)VALUES (NULL,'$this->_nombreCliente','$this->_telefonoCliente','$this->_direccionCliente','$this->_fechaRegistro')")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    $modificacion = mysqli_query($this->_conexion,"UPDATE clientes SET nombreCliente='$this->_nombreCliente',telefonoCliente='$this->_telefonoCliente',direccionCliente='$this->_direccionCliente',fechaRegistro='$this->_fechaRegistro' WHERE idClientes='$this->_idClientes'")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM clientes WHERE idClientes=$this->_idClientes")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return  $eliminacion ;
    
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idClientes)/$this->_paginacion) AS cantidad FROM clientes") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT * FROM clientes ORDER BY idClientes") or die (mysqli_error ($this->_conexion));        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $listado = mysqli_query($this->_conexion,"SELECT * FROM clientes ORDER BY idClientes LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        
    }
    return $listado;
}
}
?>