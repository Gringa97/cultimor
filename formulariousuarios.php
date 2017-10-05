<!DOCTYPE thml>
<html>
  <head>
      <meta charset="utf-8">
      <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <title>CULTIMOR</title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/font-awesome.css">
      <script src="js/jquery-3.1.1.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
    </head>
    <div class="container-fluid">
    <body>
<header>
    <center><h1>SISTEMA DE INFORMACION CULTIMOR</h1></center>
        </header>
        <?php
        $formulario = "usuarios";
          include_once("menu.php");
         
        ?>
        <center><h1>Formulario Usuario</h1></center>
        <center><table class="table">
            <tody>
                <tr>
                    <th scope="col">NombreUsusario</th>
                    <th scope="col">CorreoUsuario</th>
                    <th scope="col">ClaveUsuario</th>
                    <th scope="col">FechaRegistro</th>
                    <th scope="col">FechaUltimaClave</th>
                    <th scope="col">IdRolUsuario</th>
                </tr>
   <?php
       include_once("../modelo/conexion.php");
       $objetoConexion = new Conexion ();
       $conexion = $objetoConexion->conectar();
                
       include_once("../modelo/rol.php");
                $objetorol = new rol($conexion,0, 'nombreRol', 'arbolRol','variedadRol', 'sueloRol', 'enfermedadRol', 'produccionRol', 'ataquesRol', 'clientesRol', 'ventasRol', 'tratamientoRol', 'fumigosRol', 'foliacionRol', 'floracionRol', 'fertilizanteRol', 'fertilizacionRol', 'usuarioRol', 'auditoresRol', 'rolRol');
                $listaroles = $objetorol->listar(0);
                
        include_once("../modelo/usuarios.php");
        $objetousuario = new usuarios($conexion,0,'idUsuario', 'nombreUsuario','correoUsuario','claveUsuario','fechaRegistro','fechaUltimaClave','idRolUsuario');
        $listausuarios= $objetousuario->listar(0);
        while($unRegistro = mysqli_fetch_array($listausuarios)){
                echo '<tr><form id="fModificarUsuario"'.$unRegistro["idUsuario"].' action="../controlador/controladorusuarios.php "method="post">';
                echo  '<td><input type="hidden" name="fIdUsuario"     value="'.$unRegistro['idUsuario'].'">';
                echo '     <input type="text" class="form-control" name="fNombreUsuario" value="'.$unRegistro['nombreUsuario'].'"></td>';
                echo '<td><input type="text" class="form-control" name="fCorreoUsuario"  value="'.$unRegistro['correoUsuario'].'"></td>';
                echo '<td><input type="password" class="form-control" name="fClaveUsuario"  value="'.$unRegistro['claveUsuario'].'"></td>';
                echo '<td><input type="Date" class="form-control" name="fFechaRegistro"    value="'.$unRegistro['fechaRegistro'].'"></td>';
                echo '<td><input type="Date" class="form-control" name="fFechaUltimaClave" value="'.$unRegistro['fechaUltimaClave'].'"></td>';
            
                echo '<td><select class="form-control" name="fIdRolUsuario">';
                while($registrorol = mysqli_fetch_array($listaroles)){
                echo '<option value="'.$registrorol['idRol'].'"';
                if($unRegistro['idRolUsuario']==$registrorol['idRol']){
                     echo " selected ";
                }
                echo '>'.$registrorol['nombreRol'].'</option>';
            }
             mysqli_data_seek($listaroles,0);
            echo '</select></td>';
            
                echo '<td><button type="submit" class="btn btn-primary" name="fEnviar" value="Modificar">Modif</button>
                        <button type="submit" class="btn btn-primary" name="fEnviar" value="Eliminar">Elim</button></td>';
                    echo '</form></tr>';
                }
            ?>
                
            <tr><form id="fIngresarUsuario" action="../controlador/controladorusuarios.php" method="post">
                <td><input type="hidden" name="fIdUsuario" value="0">
                    <input type="text" class="form-control" name="fNombreUsuario"></td>
                <td><input type="text" class="form-control" name="fCorreoUsuario"></td>
                <td><input type="password" class="form-control" name="fClaveUsuario"></td>
                <td><input type="Date" class="form-control" name="fFechaRegistro"></td>
                <td><input type="Date" class="form-control" name="fFechaUltimaClave"></td>
                
                <td><select class="form-control" name="fIdRolUsuario">
                    <?php
                while($rolRegistro=mysqli_fetch_array($listaroles)){
                   echo '<option value="'.$rolRegistro['idRol'].'">'.$rolRegistro['nombreRol'].'</option>';
                }
                ?>   
                </select></td>
                
                <td><button type="submit" class="btn btn-warning" name= "fEnviar" value="Ingresar">ingresar</button> 
                    <button type="reset" class="btn btn-warning" name="fEnviar" value="limpiar">limpiar</button></td>
                </form></tr>   
            </tody>
        </table></center>
        
        <nav><ul class="pagination">
            <?php
            $cantPaginas=$objetousuario->cantidadPaginas();
            if($cantPaginas>1){
                if($pagina>1){ //mostrar el de ir atras cuando no sea la primera pagina
                    echo '<li><a href="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
                }
                for($i=1;$i<=$cantPaginas;$i++){
                    if($i==$pagina){
                        echo '<li class="active"><a href="#">'.$i.'</a></li>';
                    }else{
                        echo '<li><a href="formulariousuarios.php?pag='.$i.'">'.$i.'</a></li>';
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
        mysqli_free_result($listausuarios);
        mysqli_free_result($listaroles);
        $objetoConexion->desconectar($conexion);
        ?>
    </body>
</html>