<?php 

include("../../bd.php");

if(isset($_GET['txtid'])){
  //borrar
  //echo $_GET['txtid']; para ver si funciona
  
  $txtid=(isset($_GET['txtid']) )? $_GET['txtid']:"";

  $sentencia=$conexion->prepare(" SELECT imagen FROM tbl_portafolio WHERE id=:id ");
  $sentencia->bindParam(":id",$txtid);
  $sentencia->execute();
  $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

  if(isset($registro_imagen["imagen"])){
    if(file_exists("../../../assets/img/portafolio/".$registro_imagen["imagen"])){
      unlink("../../../assets/img/portafolio/".$registro_imagen["imagen"]);
    }
  }
  
  


  
  $sentencia=$conexion->prepare(" DELETE FROM tbl_portafolio WHERE id=:id ");
  $sentencia->bindParam(":id",$txtid);
  $sentencia->execute();
  $mensaje="registro de servicio actualizado con exito.";
  header("Location:index.php?mensaje=".$mensaje);
  
  }

//selecionar registros
$sentencia=$conexion->prepare("SELECT * FROM `tbl_portafolio`");
$sentencia->execute();
$lista_portafolio=$sentencia->fetchAll(PDO::FETCH_ASSOC);
//print_r($lista_servicios);

include("../../templates/headear.php");?>

  <div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Portafolio</a>
    </div>
    <div class="card-body">
    
    </div>
   

    <div class="table-responsive-sm">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Titulo</th>
            <!-- <th scope="col">Subtitulo</th> -->
            <th scope="col">Imagen</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Cliente&Categoria</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>

        <?php foreach($lista_portafolio as $registros) { ?>
          <tr class="">
            <td scope="col"><?php echo $registros['id'] ?></td>
            <td scope="col">
              <h6><?php echo $registros['titulo'] ?></h6>

              <?php echo $registros['subtitulo'] ?>
              <br/>
              - <?php echo $registros['url'] ?>
          
          </td>
            <td scope="col">
            <img width="50" src="../../../assets/img/portafolio/<?php echo $registros['imagen'];?> " />  
            <!-- ?php echo $registros['imagen'] ? --> </td>
            <td scope="col"><?php echo $registros['descripcion'] ?></td>
            <td scope="col">
              - <?php echo $registros['cliente'] ?><br>
              - <?php echo $registros['categoria'] ?>
            </td>
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

<?php include("../../templates/footer.php");?>