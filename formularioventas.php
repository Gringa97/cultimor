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
      <script src="js/jquery-3.1.1.slim.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
    </head>
    <div class="container-fluid">
    <body>
<header>
    <center><h1>SISTEMA DE INFORMACION CULTIMOR</h1></center>
        </header>
        <?php
        $formulario = "ventas";
          include_once("menu.php");
         
        ?>
        <center><h1>Formulario Ventas</h1></center>
        <center><table class="table">
            <tody>
                <tr>
                    <th scope="col">CantidadVentas</th>
                    <th scope="col">IdClienteVenta</th>
                </tr>
   <?php
       include_once("../modelo/conexion.php");
       $objetoConexion = new Conexion ();
       $conexion = $objetoConexion->conectar();
                
       include_once("../modelo/clientes.php");
        $objetoclientes = new clientes($conexion,0,'idClientes', 'nombreCliente','telefonoCliente','direccionCliente','fechaRegistro');
        $listaclientes= $objetoclientes->listar(0);
                
        include_once("../modelo/ventas.php");
        $objetoventas = new ventas($conexion,0,'idVentas', 'cantidadVentas','idClienteVenta');
        $listaventas= $objetoventas->listar(0);
        while($unRegistro = mysqli_fetch_array($listaventas)){
                echo '<tr><form id="fModificarVentas"'.$unRegistro["idVentas"].' action="../controlador/controladorventas.php "method="post">';
                echo  '<td><input type="hidden" name="fIdVentas"     value="'.$unRegistro['idVentas'].'">';
                echo '     <input type="number" class="form-control"  name="fCantidadVentas" value="'.$unRegistro['cantidadVentas'].'"></td>';
            
                echo '<td><select class="form-control" name="fIdClienteVenta">';
                while($registrocliente = mysqli_fetch_array($listaclientes)){
            echo '<option value="'.$registrocliente['idClientes'].'"';
            if($unRegistro['idClienteVenta']==$registrocliente['idClientes']){
                 echo " selected ";
            }
                echo '>'.$registrocliente['nombreCliente'].'</option>';
            }
             mysqli_data_seek($listaclientes,0);
            echo '</select></td>';
            
                echo '<td><button type="submit" class="btn btn-primary" name="fEnviar" value="Modificar">Modif</button>
                        <button type="submit" class="btn btn-primary" name="fEnviar" value="Eliminar">Elim</button></td>';
                    echo '</form></tr>';
                }
            ?>
                
            <tr><form id="fIngresarVentas" action="../controlador/controladorventas.php" method="post">
                <td><input type="hidden" name="fIdVentas" value="0">
                    <input type="number" class="form-control" name="fCantidadVentas"></td>
                
                <td><select class="form-control" name="fIdClienteVenta">
                    <?php
                while($clienteRegistro=mysqli_fetch_array($listaclientes)){
                   echo '<option value="'.$clienteRegistro['idCliente'].'">'.$clienteRegistro['nombreCliente'].'</option>';
                }
                ?>
                <option value="1">Doble</option>
                </select></td>
                
                <td><button type="submit" class="btn btn-warning" name= "fEnviar" value="Ingresar"><li class="fa fa-clone" aria-hidden="true"></li></button> 
                    <button type="reset" class="btn btn-warning" name="fEnviar" value="limpiar"><li class="fa fa-eraser" aria-hidden="true"></button></td>
                </form></tr>   
            </tody>
        </table></center>
        
        <nav><ul class="pagination">
            <?php
            $cantPaginas=$objetoventas->cantidadPaginas();
            if($cantPaginas>1){
                if($pagina>1){ //mostrar el de ir atras cuando no sea la primera pagina
                    echo '<li><a href="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
                }
                for($i=1;$i<=$cantPaginas;$i++){
                    if($i==$pagina){
                        echo '<li class="active"><a href="#">'.$i.'</a></li>';
                    }else{
                        echo '<li><a href="formularioventas.php?pag='.$i.'">'.$i.'</a></li>';
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
        mysqli_free_result($listaventas);
        mysqli_free_result($listaclientes);
        $objetoConexion->desconectar($conexion);
        ?>
    </body>
</html>