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
        $formulario = "produccion";
          include_once("menu.php");
         
        ?>
        <center><h1>Formulario Produccion</h1></center>
        <center><table class="table">
            <tody>
                <tr>
                    <th scope="col">FechaProduccion</th>
                    <th scope="col">GramosProducidos</th>
                    <th scope="col">GramosDesechados</th>
                    <th scope="col">IdArbolProduccion</th>
                </tr>
   <?php
       include_once("../modelo/conexion.php");
       $objetoConexion = new Conexion ();
       $conexion = $objetoConexion->conectar();
                
       include_once("../modelo/arbol.php");
        $objetoarbol = new arbol($conexion,0,'idArbol', 'alturaArbol','fechaSiembraArbol','idVariedadArbol','idSuelo','gpsArbol');
        $listaarboles= $objetoarbol->listar(0);
                
        include_once("../modelo/produccion.php");
        $objetoproduccion = new produccion($conexion,0,'idProduccion', 'fechaProduccion','gramosProducidos','gramosDesechados','idArbolProduccion');
        $listaproduccion= $objetoproduccion->listar(0);
        while($unRegistro = mysqli_fetch_array($listaproduccion)){
                echo '<tr><form id="fModificarProduccion"'.$unRegistro["idProduccion"].' action="../controlador/controladorproduccion.php "method="post">';
                echo  '<td><input type="hidden" name="fIdProduccion"     value="'.$unRegistro['idProduccion'].'">';
                echo '     <input type="Date" class="form-control" name="fFechaProduccion" value="'.$unRegistro['fechaProduccion'].'"></td>';
                echo '<td><input type="number" class="form-control" name="fGramosProducidos"  value="'.$unRegistro['gramosProducidos'].'"></td>';
                echo '<td><input type="number" class="form-control" name="fGramosDesechados"  value="'.$unRegistro['gramosDesechados'].'"></td>';
            
                echo '<td><select class="form-control" name="fIdArbolProduccion">';
                while($registroarbol = mysqli_fetch_array($listaarboles)){
                echo '<option value="'.$registroarbol['idArbol'].'"';
                if($unRegistro['idArbolProduccion']==$registroarbol['idArbol']){
                     echo " selected ";
                }
                echo '>'.$registroarbol['alturaArbol'].'</option>';
            }
             mysqli_data_seek($listaarboles,0);
            echo '</select></td>';
            
                echo '<td><button type="submit" class="btn btn-primary" name="fEnviar" value="Modificar">Modif</button>
                        <button type="submit" class="btn btn-primary" name="fEnviar" value="Eliminar">Elim</button></td>';
                    echo '</form></tr>';
                }
            ?>
                
            <tr><form id="fIngresarProduccion" action="../controlador/controladorproduccion.php" method="post">
                <td><input type="hidden" name="fIdProduccion" value="0">
                    <input type="Date" class="form-control" name="fFechaProduccion"></td>
                <td><input type="number" class="form-control" name="fGramosProducidos"></td>
                <td><input type="number" class="form-control" name="fGramosDesechados"></td>
                
                <td><select class="form-control" name="fIdArbolProduccion">
                    <?php
                while($arbolRegistro=mysqli_fetch_array($listaarboles)){
                   echo '<option value="'.$arbolRegistro['idArbol'].'">'.$arbolRegistro['alturaArbol'].'</option>';
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
            $cantPaginas=$objetoproduccion->cantidadPaginas();
            if($cantPaginas>1){
                if($pagina>1){ //mostrar el de ir atras cuando no sea la primera pagina
                    echo '<li><a href="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
                }
                for($i=1;$i<=$cantPaginas;$i++){
                    if($i==$pagina){
                        echo '<li class="active"><a href="#">'.$i.'</a></li>';
                    }else{
                        echo '<li><a href="formularioproduccion.php?pag='.$i.'">'.$i.'</a></li>';
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
        mysqli_free_result($listaproduccion);
        mysqli_free_result($listaarboles);
        $objetoConexion->desconectar($conexion);
        ?>
    </body>
</html>