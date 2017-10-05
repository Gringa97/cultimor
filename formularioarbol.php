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
           $formulario = "arbol";
           include_once("menu.php");
           $pagina = (isset($_GET['pag']))?$_GET['pag']:"1";
        ?>
        <center><h1>Formulario Arbol</h1></center>
        <center><table class="table">
            <tody>
                <tr>
                    <th scope="col">AlturaArbol</th>
                    <th scope="col">FechaSiembraArbol</th>
                    <th scope="col">IdVariedadArbol</th>
                    <th scope="col">IdSuelo</th>
                    <th scope="col">GpsArbol</th>
                </tr>
   <?php
       include_once("../modelo/conexion.php");
       $objetoConexion = new Conexion ();
       $conexion = $objetoConexion->conectar();
                
       include_once("../modelo/variedad.php");
        $objetovariedad = new variedad($conexion,0,'idVariedad','nombreVariedad');
        $listavariedad= $objetovariedad->listar(0);
                
        include_once("../modelo/suelo.php");
        $objetosuelo = new suelo($conexion,0,'idSuelo','nombreSuelo');
        $listasuelos= $objetosuelo->listar(0);
                
        include_once("../modelo/arbol.php");
        $objetoarbol = new arbol($conexion,0,'idArbol', 'alturaArbol','fechaSiembraArbol','idVariedadArbol','idSuelo','gpsArbol');
        $listaarboles= $objetoarbol->listar($pagina);
        while($unRegistro = mysqli_fetch_array($listaarboles)){
                echo '<tr><form id="fModificarArbol"'.$unRegistro["idArbol"].' action="../controlador/controladorarbol.php "method="post">';
                echo  '<td><input type="hidden" name="fIdArbol"       value="'.$unRegistro['idArbol'].'">';
                echo ' <input type="number" class="form-control" name="fAlturaArbol"   value="'.$unRegistro['alturaArbol'].'"></td>';
                echo '<td><input type="date"  class="form-control" name="fFechaSiembraArbol"  value="'.$unRegistro['fechaSiembraArbol'].'"></td>';
            
                echo '<td><select  class="form-control" name="fIdVariedadArbol">';
                while($registrovariedad = mysqli_fetch_array($listavariedad)){
                echo '<option value="'.$registrovariedad['idVariedad'].'"';
                if($unRegistro['idVariedadArbol']==$registrovariedad['idVariedad']){
                     echo " selected ";
                }
                echo '>'.$registrovariedad['nombreVariedad'].'</option>';
            }
             mysqli_data_seek($listavariedad,0);
            echo '</select></td>';
            
            
                echo '<td><select  class="form-control" name="fIdSuelo">';
                while($registrosuelo = mysqli_fetch_array($listasuelos)){
            echo '<option value="'.$registrosuelo['idSuelo'].'"';
            if($unRegistro['idSuelo']==$registrosuelo['idSuelo']){
                 echo " selected ";
            }
                echo '>'.$registrosuelo['nombreSuelo'].'</option>';
            }
             mysqli_data_seek($listasuelos,0);
            echo '</select></td>';
            
                echo '<td><input type="text"  class="form-control"  name="fGpsArbol" value="'.$unRegistro['gpsArbol'].'"></td>';  
                echo '<td><button type="submit" class="btn btn-primary" name="fEnviar" value="Modificar">Modif</button>
                        <button type="submit" class="btn btn-primary" name="fEnviar" value="Eliminar">Elim</button></td>';
                    echo '</form></tr>';
                }
            ?>
                
            <tr><form id="fIngresarArbol" action="../controlador/controladorarbol.php" method="post">
                <td><input type="hidden" name="fIdArbol" value="0">
                    <input type="number"  class="form-control" name="fAlturaArbol"></td>
                <td><input type="date" class="form-control" name="fFechaSiembraArbol"></td>
                
                <td><select class="form-control" name="fIdVariedadArbol">
                    <?php
                while($variedadRegistro=mysqli_fetch_array($listavariedad)){
                   echo '<option value="'.$variedadRegistro['idVariedad'].'">'.$variedadRegistro['nombreVariedad'].'</option>';
                }
                ?>   
                </select></td>
                
                <td><select class="form-control" name="fIdSuelo">
                    <?php
                while($sueloRegistro=mysqli_fetch_array($listasuelos)){
                   echo '<option value="'.$sueloRegistro['idSuelo'].'">'.$sueloRegistro['nombreSuelo'].'</option>';
                }
                ?>
                <option value="1">Doble</option>
                </select></td>
                
                <td><input type="text" class="form-group" name="fGpsArbol"></td>
                
                <td><button type="submit" class="btn btn-warning" name= "fEnviar" value="Ingresar">ingresar</button></div> 
                    <button type="reset" class="btn btn-warning" name="fEnviar" value="limpiar">limpiar</button></div></td>
                </form></tr>   
            </tody>
        </table></center>
        
        <nav><ul class="pagination">
            <?php
            $cantPaginas=$objetoarbol->cantidadPaginas();
            if($cantPaginas>1){
                if($pagina>1){ //mostrar el de ir atras cuando no sea la primera pagina
                    echo '<li><a href="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
                }
                for($i=1;$i<=$cantPaginas;$i++){
                    if($i==$pagina){
                        echo '<li class="active"><a href="#">'.$i.'</a></li>';
                    }else{
                        echo '<li><a href="formularioarbol.php?pag='.$i.'">'.$i.'</a></li>';
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
        mysqli_free_result($listaarboles);
        mysqli_free_result($listavariedad);
        mysqli_free_result($listasuelos);
        $objetoConexion->desconectar($conexion);
        ?>
    </body>
</html>