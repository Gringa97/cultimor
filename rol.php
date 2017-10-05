<?php
class rol{
    
    private $_conexion;
    private $_idRol;
    private $_nombreRol;
    private $_arbolRol;
    private $_variedadRol;
    private $_sueloRol;
    private $_enfermedadRol;
    private $_produccionRol;
    private $_ataquesRol;
    private $_clientesRol;
    private $_ventasRol;
    private $_tratamientoRol;
    private $_fumigosRol;
    private $_foliacionRol;
    private $_floracionRol;
    private $_fertilizanteRol;
    private $_fertilizacionRol;
    private $_usuarioRol;
    private $_auditoresRol;
    private $_rolRol;
    private $_paginacion = 10;
    
    function __construct($conexion, $idRol, $nombreRol, $arbolRol, $variedadRol, $sueloRol, $enfermedadRol, $produccionRol, $ataquesRol, $clientesRol, $ventasRol, $tratamientoRol, $fumigosRol, $foliacionRol, $floracionRol, $fertilizanteRol, $fertilizacionRol, $usuarioRol, $auditoresRol, $rolRol){
        
    $this->_conexion = $conexion;
    $this->_idRol = $idRol;
    $this->_nombreRol = $nombreRol;
    $this->_arbolRol = $arbolRol;
    $this->_variedadRol = $variedadRol;
    $this->_sueloRol = $sueloRol;
    $this->_enfermedadRol = $enfermedadRol;
    $this->_produccionRol = $produccionRol;
    $this->_ataquesRol = $ataquesRol;
    $this->_clientesRol = $clientesRol;
    $this->_ventasRol = $ventasRol;
    $this->_tratamientoRol = $tratamientoRol;
    $this->_fumigosRol = $fumigosRol;
    $this->_foliacionRol = $foliacionRol;
    $this->_floracionRol = $floracionRol;
    $this->_fertilizanteRol = $fertilizanteRol;
    $this->_fertilizacionRol = $fertilizacionRol;
    $this->_usuarioRol = $usuarioRol;
    $this->_auditoresRol = $auditoresRol;
    $this->_rolRol = $rolRol;
    
}
function __get($k){
    return $this->$k;
}

function __set($k,$v){
    
    $this->$k =$v;
}

function ingresar (){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO rol (idRol,nombreRol,arbolRol,variedadRol,sueloRol,enfermedadRol,produccionRol,ataquesRol,clientesRol,ventasRol,tratamientoRol,fumigosRol,foliacionRol,floracionRol,fertilizanteRol,fertilizacionRol,usuarioRol,auditoresRol,rolRol)VALUES (NULL,'$this->_nombreRol','$this->_arbolRol','$this->_variedadRol','$this->_sueloRol','$this->_enfermedadRol','$this->_produccionRol','$this->_ataquesRol','$this->_clientesRol','$this->_ventasRol','$this->_tratamientoRol','$this->_fumigosRol','$this->_foliacionRol','$this->_floracionRol','$this->_fertilizanteRol','$this->_fertilizacionRol','$this->_usuarioRol','$this->_auditoresRol','$this->_rolRol')") or die (mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    $modificacion = mysqli_query($this->_conexion,"UPDATE rol SET nombreRol='$this->_nombreRol',arbolRol='$this->_arbolRol',variedadRol='$this->_variedadRol',sueloRol='$this->_sueloRol',enfermedadRol='$this->_enfermedadRol',produccionRol='$this->_produccionRol', ataquesRol='$this->_ataquesRol',clientesRol='$this->_clientesRol',ventasRol='$this->_ventasRol',tratamientoRol='$this->_tratamientoRol',fumigosRol='$this->_fumigosRol',foliacionRol='$this->_foliacionRol',floracionRol='$this->_floracionRol',fertilizanteRol='$this->_fertilizanteRol',fertilizacionRol='$this->_fertilizacionRol',usuarioRol='$this->_usuarioRol',auditoresRol='$this->_auditoresRol', rolRol='$this->_rolRol' WHERE idRol=$this->_idRol")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM rol WHERE idRol=$this->_idRol");
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return  $insercion;
    
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idRol)/$this->_paginacion) AS cantidad FROM rol") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT * FROM rol ORDER BY idRol") or die (mysqli_error ($this->coexion));
        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $lista = mysqli_query($this->_conexion,"SELECT * FROM rol ORDER BY idRol LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->conexion));
        
    }
    return $listado;
}
}
?>

