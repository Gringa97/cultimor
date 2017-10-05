<!DOCTYPE thml>
<html>
  <head>
      <meta charset="utf-8">
      <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <title> CULTIMOR</title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/font-awesome.css">
      <script src="js/jquery-3.1.1.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      
    </head>
    <body>
<header>
    <center><h1>SISTEMA DE INFORMACION CULTIMOR</h1></center>
        </header>
        <?php
        $formulario = "rol";
        include_once("menu.php");
        ?>
        <div class="container-fluid">
         <center><h1>Formulario Rol</h1></center>
        <center><table class="table table-striped table-responsive">
            <tody>
                <tr>
                    <th scope="col">NombreRol</th>
                    <th scope="col">ArbolRol</th>
                    <th scope="col">VariedadRol</th>
                    <th scope="col">SueloRol</th>
                    <th scope="col">EnfermedadRol</th>
                    <th scope="col">ProduccionRol</th>
                    <th scope="col">AtaquesRol</th>
                    <th scope="col">ClientesRol</th>
                    <th scope="col">VentasRol</th>
                    <th scope="col">TratamientoRol</th>
                    <th scope="col">FumigosRol</th>
                    <th scope="col">FoliacionRol</th>
                    <th scope="col">FloracionRol</th>
                    <th scope="col">FertilizanteRol</th>
                    <th scope="col">FertilizacionRol</th>
                    <th scope="col">UsuarioRol</th>
                    <th scope="col">AuditoresRol</th>
                    <th scope="col">RolRol</th>
                </tr>
   <?php
       include_once("../modelo/conexion.php");
       $objetoConexion = new conexion ();
       $conexion = $objetoConexion->conectar();
                
        include_once("../modelo/rol.php");
                $objetorol = new rol($conexion,0, 'nombreRol', 'arbolRol','variedadRol', 'sueloRol', 'enfermedadRol', 'produccionRol', 'ataquesRol', 'clientesRol', 'ventasRol', 'tratamientoRol', 'fumigosRol', 'foliacionRol', 'floracionRol', 'fertilizanteRol', 'fertilizacionRol', 'usuarioRol', 'auditoresRol', 'rolRol');
                $listaroles = $objetorol->listar(0);
                while($unRegistro = mysqli_fetch_array($listaroles)){
                    echo '<tr><form id="fModificarRol'.$unRegistro["idRol"].'" action="../controlador/controladorrol.php" method="post">';
                    echo '<td><input type="hidden" name="fIdRol"          value="'.$unRegistro['idRol'].'">';
                    echo '<input     type="text" class="form-control" name="fNombreRol"        value="'.$unRegistro['nombreRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fArbolRol"         value="'.$unRegistro['arbolRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fVariedadRol"      value="'.$unRegistro['variedadRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fSueloRol"         value="'.$unRegistro['sueloRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fEnfermedadRol"    value="'.$unRegistro['enfermedadRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fProduccionRol"    value="'.$unRegistro['produccionRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fAtaquesRol"        value="'.$unRegistro['ataquesRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fClientesRol"       value="'.$unRegistro['clientesRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fVentasRol"        value="'.$unRegistro['ventasRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fTratamientoRol"   value="'.$unRegistro['tratamientoRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fFumigosRol"         value="'.$unRegistro['fumigosRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fFoliacionRol"      value="'.$unRegistro['foliacionRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fFloracionRol"     value="'.$unRegistro['floracionRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fFertilizanteRol" value="'.$unRegistro['fertilizanteRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fFertilizacionRol" value="'.$unRegistro['fertilizacionRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fUsuarioRol"      value="'.$unRegistro['usuarioRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fAuditoresRol"     value="'.$unRegistro['auditoresRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fRolRol"           value="'.$unRegistro['rolRol'].'"></td>';                    
                 echo '<td><button type="submit" class="btn btn-primary" name="fEnviar" value="Modificar">Modifi</button>
                        <button type="submit" class="btn btn-primary" name="fEnviar" value="Eliminar">Elim</button></td>';
                    echo '</form></tr>';
                }
            ?>
                
            <tr><form id="fIngresarrol" action="../controlador/controladorrol.php" method="post">
                
                <td><input type="hidden" name="fIdRol" value="0">
                    <input type="text" class="form-control" name="fNombreRol"></td>
                <td><input type="text" class="form-control" name="fArbolRol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fVariedadRol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fSueloRol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fEnfermedadRol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fProduccionRol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fAtaquesRol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fClientesRol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fVentasRol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fTratamientoRol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fFumigosRol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fFoliacionRol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fFloracionRol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fFertilizanteRol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fFertilizacionRol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fUsuarioRol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fAuditoresRol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fRolRol" placeholder="crud"></td>
                 <td><button type="submit" class="btn btn-warning" name= "fEnviar" value="Ingresar">ingresar</button> 
                    <button type="reset" class="btn btn-warning" name="fEnviar" value="limpiar">limpiar</button></td>
                </form></tr>   
            </tody>
        </table></center>
        
        <nav><ul class="pagination">
            <?php
            $cantPaginas=$objetorol->cantidadPaginas();
            if($cantPaginas>1){
                if($pagina>1){ //mostrar el de ir atras cuando no sea la primera pagina
                    echo '<li><a href="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
                }
                for($i=1;$i<=$cantPaginas;$i++){
                    if($i==$pagina){
                        echo '<li class="active"><a href="#">'.$i.'</a></li>';
                    }else{
                        echo '<li><a href="formulariorol.php?pag='.$i.'">'.$i.'</a></li>';
                    }
                }
                if ($pagina<$cantPaginas){ //mostrar el de ir adelante cuando no sea la ultima pagina
                    echo '<li><a href="#" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
                }
            }
            ?>
            </ul></nav>
            </div>
        
        <?php
        mysqli_free_result($listaroles);
        $objetoConexion->desconectar($conexion);
        ?>
    </body>
</html>
                