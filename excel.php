<div class="">
  <table>
      <tr>
        <th>id</th>
        <th>Producto</th>
        <th>Origen</th>
        <th>Fuente</th>
        <th>Parroquia</th>
        <th>fecha</th>
        <th>Precio</th>
        <th>Usuario</th>
        <th>acciones</th>
      </tr>
      <?php
        $fecha = $_GET["datos"];
        
        $conexion = pg_connect("host=localhost dbname=seguimiento user=postgres password=aed09f75aa");
        $precio = "SELECT * FROM productos" ;
        $ejecutar = pg_query($conexion, $precio);
       
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=producto_".$fecha.".xls");  
       
        while($fila=pg_fetch_array($ejecutar)){ ?>
        
        <tr>
          <td><?php echo $fila[0]?></td>
          <td><?php echo $fila[1]?></td>
        </tr>
  
  <?php } ?>



  </table>
</div>