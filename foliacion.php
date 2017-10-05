<?php
class Foliacion{
    
    private $_conexion;
    private $_idFoliacion;
    private $_cantidadHojas;
    private $_areaHoja;
    private $_idArbol;
    private $_paginacion = 10;
    
    function __construct($conexion, $idFoliacion, $cantidadHojas, $areaHoja, $idArbol){
        $this->_conexion = $conexion;
        $this->_idFoliacion = $idFoliacion;
        $this->_cantidadHojas = $cantidadHojas;
        $this->_areaHoja = $areaHoja;
        $this->_idArbol = $idArbol;
   
    }
function __get($k){
    return $this->$k;
}

function __set($k,$v){

    $this->$k =$v;
}

function Ingresar(){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO foliacion (idFoliacion,cantidadHojas,areaHoja,idArbol)VALUES (NULL,'$this->_cantidadHojas','$this->_areaHoja','$this->_idArbol')")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    $modificacion = mysqli_query($this->_conexion,"UPDATE foliacion SET cantidadHojas='$this->_cantidadHojas',areaHoja='$this->_areaHoja',idArbol='$this->_idArbol' WHERE idFoliacion='$this->_idFoliacion'")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM foliacion WHERE idFoliacion=$this->_idFoliacion")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return  $eliminacion ;
    
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idFoliacion)/$this->_paginacion) AS cantidad FROM foliacion") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT * FROM foliacion ORDER BY idFoliacion") or die (mysqli_error ($this->_conexion));        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $listado = mysqli_query($this->_conexion,"SELECT * FROM foliacion ORDER BY idFoliacion LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        
    }
    return $listado;
}
}
?>