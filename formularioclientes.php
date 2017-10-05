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
        $formulario = "clientes";
          include_once("menu.php");
         
        ?>
        <center><h1>Formulario Clientes</h1></center>
        <center><table class="table">
            <tody>
                <tr>
                    <th scope="col">NombreCliente</th>
                    <th scope="col">TelfonoCliente</th>
                    <th scope="col">DireccionCliente</th>
                    <th scope="col">FechaRegistro</th>
                </tr>
   <?php
       include_once("../modelo/conexion.php");
       $objetoConexion = new Conexion ();
       $conexion = $objetoConexion->conectar();
                
        include_once("../modelo/clientes.php");
        $objetoclientes = new clientes($conexion,0,'idClientes', 'nombreCliente','telefonoCliente','direccionCliente','fechaRegistro');
        $listaclientes= $objetoclientes->listar(0);
        while($unRegistro = mysqli_fetch_array($listaclientes)){
                echo '<tr><form id="fModificarClientes"'.$unRegistro["idClientes"].' action="../controlador/controladorclientes.php "method="post">';
                echo  '<td><input type="hidden" name="fIdClientes"     value="'.$unRegistro['idClientes'].'">';
                echo '     <input type="text" class="form-control"  name="fNombreCliente" value="'.$unRegistro['nombreCliente'].'"></td>';
                echo '<td><input type="number"  class="form-control" name="fTelefonoCliente"  value="'.$unRegistro['telefonoCliente'].'"></td>';
                echo '<td><input type="text" class="form-control" name="fDireccionCliente"  value="'.$unRegistro['direccionCliente'].'"></td>';
                echo '<td><input type="Date"  class="form-control"  name="fFechaRegistro"    value="'.$unRegistro['fechaRegistro'].'"></td>'; 
                echo '<td><button type="submit" class="btn btn-primary" name="fEnviar" value="Modificar">Modif</button>
                        <button type="submit" class="btn btn-primary" name="fEnviar" value="Eliminar">Elim</button></td>';
                    echo '</form></tr>';
                }
            ?>
                
            <tr><form id="fIngresarClientes" action="../controlador/controladorclientes.php" method="post">
                <td><input type="hidden" name="fIdClientes" value="0">
                    <input type="text" class="form-control" name="fNombreCliente"></td>
                <td><input type="number" class="form-control" name="fTelefonoCliente"></td>
                <td><input type="text" class="form-control" name="fDireccionCliente"></td>
                <td><input type="Date" class="form-control" name="fFechaRegistro"></td>
                <td><button type="submit" class="btn btn-warning" name= "fEnviar" value="Ingresar">ingresar</button> 
                    <button type="reset" class="btn btn-warning" name="fEnviar" value="limpiar">limpiar</button></td>
                </form></tr>   
            </tody>
        </table></center>
        
        <nav><ul class="pagination">
            <?php
            $cantPaginas=$objetoclientes->cantidadPaginas();
            if($cantPaginas>1){
                if($pagina>1){ //mostrar el de ir atras cuando no sea la primera pagina
                    echo '<li><a href="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
                }
                for($i=1;$i<=$cantPaginas;$i++){
                    if($i==$pagina){
                        echo '<li class="active"><a href="#">'.$i.'</a></li>';
                    }else{
                        echo '<li><a href="formularioclientes.php?pag='.$i.'">'.$i.'</a></li>';
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
        mysqli_free_result($listaclientes);
        $objetoConexion->desconectar($conexion);
        ?>
    </body>
</html>