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
        $formulario = "tratamiento";
          include_once("menu.php");
         
        ?>
        <center><h1>Formulario Tratamiento</h1></center>
        <center><table class="table">
            <tody>
                <tr>
                    <th scope="col">FechaTratamiento</th>
                    <th scope="col">DescripcionTratamiento</th>
                    <th scope="col">IdAtaqueTratamiento</th>
                </tr>
   <?php
       include_once("../modelo/conexion.php");
       $objetoConexion = new Conexion ();
       $conexion = $objetoConexion->conectar();
                
       include_once("../modelo/ataques.php");
        $objetoataques = new ataques($conexion,0,'idAtaques', 'fechaAtaque','porcentajeInfectasion','idArbolAtaque','idEnfermedadaAtaque');
        $listaataques= $objetoataques->listar(0);
                
        include_once("../modelo/tratamiento.php");
        $objetotratamiento = new tratamiento($conexion,0,'idTratamiento', 'fechaTratamiento','descripcionTratamiento','idAtaqueTratamiento');
        $listatratamientos= $objetotratamiento->listar(0);
        while($unRegistro = mysqli_fetch_array($listatratamientos)){
                echo '<tr><form id="fModificarTratamiento"'.$unRegistro["idTratamiento"].' action="../controlador/controladortratamiento.php "method="post">';
                echo  '<td><input type="hidden" name="fIdTratamiento"     value="'.$unRegistro['idTratamiento'].'">';
                echo '     <input type="Date" class="form-control" name="fFechaTratamiento" value="'.$unRegistro['fechaTratamiento'].'"></td>';
                echo '<td><input type="text" class="form-control" name="fDescripcionTratamiento"  value="'.$unRegistro['descripcionTratamiento'].'"></td>';
            
                echo '<td><select class="form-control" name="fIdAtaqueTratamiento">';
                 while($registroataque = mysqli_fetch_array($listaataques)){
                echo '<option value="'.$registroataque['idAtaques'].'"';
                if($unRegistro['idAtaqueTratamiento']==$registroataque['idAtaques']){
                     echo " selected ";
                }
                echo '>'.$registroataque['fechaAtaque'].'</option>';
            }
             mysqli_data_seek($listaataques,0);
            echo '</select></td>';
            
                echo '<td><button type="submit" class="btn btn-primary" name="fEnviar" value="Modificar">Modif</button>
                        <button type="submit" class="btn btn-primary" name="fEnviar" value="Eliminar">Elim</button></td>';
                    echo '</form></tr>';
                }
            ?>
                
            <tr><form id="fIngresarTratamiento" action="../controlador/controladortratamiento.php" method="post">
                <td><input type="hidden" name="fIdTratamiento" value="0">
                    <input type="Date" class="form-control" name="fFechaTratamiento"></td>
                <td><input type="text" class="form-control" name="fDescripcionTratamiento"></td>
                
                <td><select class="form-control" name="fIdAtaqueTratamiento">
                    <?php
                while($ataqueRegistro=mysqli_fetch_array($listaataques)){
                   echo '<option value="'.$ataqueRegistro['idAtaque'].'">'.$ataqueRegistro['fechaAtaque'].'</option>';
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
            $cantPaginas=$objetotratamiento->cantidadPaginas();
            if($cantPaginas>1){
                if($pagina>1){ //mostrar el de ir atras cuando no sea la primera pagina
                    echo '<li><a href="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
                }
                for($i=1;$i<=$cantPaginas;$i++){
                    if($i==$pagina){
                        echo '<li class="active"><a href="#">'.$i.'</a></li>';
                    }else{
                        echo '<li><a href="formulariotratamiento.php?pag='.$i.'">'.$i.'</a></li>';
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
        mysqli_free_result($listatratamientos);
        mysqli_free_result($listaataques);
        $objetoConexion->desconectar($conexion);
        ?>
    </body>
</html>