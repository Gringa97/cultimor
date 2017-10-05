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
        $formulario = "fertilizante";
          include_once("menu.php");
         
        ?>
        <center><h1>Formulario Fertilizante</h1></center>
        <center><table class="table">
            <tody>
                <tr>
                    <th scope="col">IdFertilizante</th>
                    <th scope="col">NombreFertilizante</th>
                </tr>
   <?php
       include_once("../modelo/conexion.php");
       $objetoConexion = new Conexion ();
       $conexion = $objetoConexion->conectar();
                
        include_once("../modelo/fertilizante.php");
        $objetofertilizante = new fertilizante($conexion,0,'idFertilizante','nombreFertilizante');
        $listafertilizantes= $objetofertilizante->listar(0);
        while($unRegistro = mysqli_fetch_array($listafertilizantes)){
                echo '<tr><form id="fModificarFertilizante"'.$unRegistro["idFertilizante"].' action="../controlador/controladorfertilizante.php "method="post">';
                echo  '<td><input type="hidden" name="fIdFertilizante"     value="'.$unRegistro['idFertilizante'].'">';
                echo '<td><input type="text" class="form-control" name="fNombreFertilizante"  value="'.$unRegistro['nombreFertilizante'].'"></td>';
                echo '<td><button type="submit" class="form-group" name="fEnviar" value="Modificar">Modif</button>
                        <button type="submit" class="btn btn-primary" name="fEnviar" value="Eliminar">Elim</button></td>';
                    echo '</form></tr>';
                }
            ?>
                
            <tr><form id="fIngresarFertilizante" action="../controlador/controladorfertilizante.php" method="post">
                <td><input type="hidden" name="fIdFertilizante" value="0">
                <td><input type="text" class="form-control" name="fNombreFertilizante"></td>
                <td><button type="submit" class="btn btn-warning" name= "fEnviar" value="Ingresar">ingresar</button> 
                    <button type="reset" class="btn btn-warning" name="fEnviar" value="limpiar">limpiar</button></td>
                </form></tr>   
            </tody>
        </table></center>
        
        <nav><ul class="pagination">
            <?php
            $cantPaginas=$objetofertilizante->cantidadPaginas();
            if($cantPaginas>1){
                if($pagina>1){ //mostrar el de ir atras cuando no sea la primera pagina
                    echo '<li><a href="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
                }
                for($i=1;$i<=$cantPaginas;$i++){
                    if($i==$pagina){
                        echo '<li class="active"><a href="#">'.$i.'</a></li>';
                    }else{
                        echo '<li><a href="formulariofertilizante.php?pag='.$i.'">'.$i.'</a></li>';
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
        mysqli_free_result($listafertilizantes);
        $objetoConexion->desconectar($conexion);
        ?>
    </body>
</html>