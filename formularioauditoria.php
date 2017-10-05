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
        $formulario = "auditoria";
          include_once("menu.php");
         
        ?>
        <center><h1>Formulario Auditoria</h1></center>
        <center><table class="table">
            <tody>
                <tr>
                    <th scope="col">FechaAuditoria</th>
                    <th scope="col">DescripcionAuditoria</th>
                    <th scope="col">IdUsuarioAuditoria</th>
                </tr>
   <?php
       include_once("../modelo/conexion.php");
       $objetoConexion = new Conexion ();
       $conexion = $objetoConexion->conectar();
                
       include_once("../modelo/usuarios.php");
        $objetousuario = new usuarios($conexion,0,'idUsuario', 'nombreUsuario','correoUsuario','claveUsuario','fechaRegistro','fechaUltimaClave','idRolUsuario');
        $listausuarios= $objetousuario->listar(0);
                
        include_once("../modelo/auditoria.php");
        $objetoauditoria = new auditoria($conexion,0,'idAuditoria', 'fechaAuditoria','descripcionAuditoria','idUsuarioAuditoria');
        $listaAuditorias= $objetoauditoria->listar(0);
        while($unRegistro = mysqli_fetch_array($listaAuditorias)){
                echo '<tr><form id="fModificarAuditoria"'.$unRegistro["idAuditoria"].' action="../controlador/controladorauditoria.php "method="post">';
                echo  '<td><input type="hidden" name="fIdAuditoria"     value="'.$unRegistro['idAuditoria'].'">';
                echo '     <input type="Date" class="form-control"  name="fFechaAuditoria" value="'.$unRegistro['fechaAuditoria'].'"></td>';
                echo '<td><input type="text"  class="form-control"  name="fDescripcionAuditoria"  value="'.$unRegistro['descripcionAuditoria'].'"></td>';
            
                echo '<td><select class="form-control"  name="fIdUsuarioAuditoria">';
                while($registrousuario = mysqli_fetch_array($listausuarios)){
                echo '<option value="'.$registrousuario['idUsuario'].'"';
                if($unRegistro['idUsuarioAuditoria']==$registrousuario['idUsuario']){
                     echo " selected ";
                }
                echo '>'.$registrousuario['nombreUsuario'].'</option>';
            }
             mysqli_data_seek($listausuarios,0);
            echo '</select></td>';
            
                echo '<td><button type="submit" class="btn btn-primary" name="fEnviar" value="Modificar">Modif</button>
                        <button type="submit" class="btn btn-primary" name="fEnviar" value="Eliminar">Elim</button></td>';
                    echo '</form></tr>';
                }
            ?>
                
            <tr><form id="fIngresarAtaques" action="../controlador/controladorauditoria.php" method="post">
                <td><input type="hidden" name="fIdAuditoria" value="0">
                    <input type="Date" class="form-control" name="fFechaAuditoria"></td>
                <td><input type="text" class="form-control" name="fDescripcionAuditoria"></td>
                
                <td><select class="form-control" name="fIdUsuarioAuditoria">
                    <?php
                while($usuarioRegistro=mysqli_fetch_array($listausuarios)){
                   echo '<option value="'.$usuarioRegistro['id'].'">'.$usuarioRegistro['nombreUsuario'].'</option>';
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
            $cantPaginas=$objetoauditoria->cantidadPaginas();
            if($cantPaginas>1){
                if($pagina>1){ //mostrar el de ir atras cuando no sea la primera pagina
                    echo '<li><a href="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
                }
                for($i=1;$i<=$cantPaginas;$i++){
                    if($i==$pagina){
                        echo '<li class="active"><a href="#">'.$i.'</a></li>';
                    }else{
                        echo '<li><a href="formularioauditoria.php?pag='.$i.'">'.$i.'</a></li>';
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
        mysqli_free_result($listaAuditorias);
        mysqli_free_result($listausuarios);
        $objetoConexion->desconectar($conexion);
        ?>
    </body>
</html>