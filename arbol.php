<?php
class Arbol{
    
    private $_conexion;
    private $_idArbol;
    private $_alturaArbol;
    private $_fechasiembraArbol;
    private $_idVariedadArbol;
    private $_idSuelo;
     private $_gpsArbol;
    private $_paginacion = 10;
    
    function __construct($conexion, $idArbol, $alturaArbol, $fechaSiembraArbol, $idVariedadArbol, $idSuelo, $gpsArbol){
        $this->_conexion = $conexion;
        $this->_idArbol = $idArbol;
        $this->_alturaArbol = $alturaArbol;
        $this->_fechaSiembraArbol = $fechaSiembraArbol;
        $this->_idVariedadArbol = $idVariedadArbol;
        $this->_idSuelo = $idSuelo;
        $this->_gpsArbol = $gpsArbol;

    }
function __get($k){
    return $this->$k;
}

function __set($k,$v){

    $this->$k =$v;
}

function insertar(){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO arbol (idArbol,alturaArbol,fechaSiembraArbol,idVariedadArbol,idSuelo,gpsArbol) VALUES (NULL,'$this->_alturaArbol','$this->_fechaSiembraArbol','$this->_idVariedadArbol','$this->_idSuelo',ST_GeomFromText('$this->_gpsArbol'))") or die (mysqli_error ($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    
    $modificacion = mysqli_query($this->_conexion,"UPDATE arbol SET alturaArbol='$this->_alturaArbol',fechaSiembraArbol='$this->_fechaSiembraArbol',idVariedadArbol='$this->_idVariedadArbol',idSuelo='$this->_idSuelo',gpsArbol=ST_GeomFromText('$this->_gpsArbol') WHERE idArbol='$this->_idArbol'") or die (mysqli_error ($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM arbol WHERE idArbol=$this->_idArbol");
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $eliminacion;
    
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idArbol)/$this->_paginacion) AS cantidad FROM arbol") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT idArbol,alturaArbol,fechaSiembraArbol,idVariedadArbol,idSuelo, ST_AsText(gpsArbol) As gpsArbol FROM arbol ORDER BY idArbol") or die (mysqli_error ($this->_conexion));        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $listado = mysqli_query($this->_conexion,"SELECT idArbol,alturaArbol,fechaSiembraArbol,idVariedadArbol,idSuelo,  ST_AsText(gpsArbol) As gpsArbol FROM arbol ORDER BY idArbol LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        
    }
    return $listado;
}
}
?>







