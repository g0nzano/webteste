<?php
 include("../../bd.php");

 if(isset($_GET['txtid'])){
  //borrar
  //echo $_GET['txtid']; para ver si funciona
  
  $txtid=(isset($_GET['txtid']) )? $_GET['txtid']:"";

  $sentencia=$conexion->prepare(" SELECT imagen FROM tbl_entradas WHERE id=:id ");
  $sentencia->bindParam(":id",$txtid);
  $sentencia->execute();
  $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

  if(isset($registro_imagen["imagen"])){
    if(file_exists("../../../assets/img/about/".$registro_imagen["imagen"])){
      unlink("../../../assets/img/about/".$registro_imagen["imagen"]);
    }
  }

    


  
  $sentencia=$conexion->prepare(" DELETE FROM tbl_entradas WHERE id=:id ");
  $sentencia->bindParam(":id",$txtid);
  $sentencia->execute();
  $mensaje="registro de servicio actualizado con exito.";
  header("Location:index.php?mensaje=".$mensaje);
  
  }

//selecionar registros
$sentencia=$conexion->prepare("SELECT * FROM `tbl_entradas`");
$sentencia->execute();
$lista_entradas=$sentencia->fetchAll(PDO::FETCH_ASSOC);

 include("../../templates/headear.php");
 
 ?>


<div class="card">
  <div class="card-header">
  <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Entradas</a>
  </div>
  <div class="card-body">
    <div class="table-responsive-sm">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Fecha</th>
            <th scope="col">Titulo</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Imagen</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>

        <?php foreach($lista_entradas as $registros) { ?>
          <tr class="">
          <td scope="col"><?php echo $registros['id'] ?></td>
          <td scope="col"><?php echo $registros['fecha'] ?></td>
          
          <br/>
          <td scope="col"><?php echo $registros['titulo'] ?></td>
          <td scope="col"><?php echo $registros['descripcion'] ?></td>
            <td scope="col">
            <img width="50" src="../../../assets/img/about/<?php echo $registros['imagen'];?> " /> 
            <td>
            <a name="" id="" class="btn btn-info" href="editar.php?txtid=<?php echo $registros['id'] ?>" role="button">Editar</a>
            |
            <a name="" id="" class="btn btn-danger" href="index.php?txtid=<?php echo $registros['id'] ?>" role="button">Eliminar</a>
          </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    
  </div>
  <div class="card-footer text-muted">
   
  </div>
</div>

<?php include("../../templates/footer.php");?>
