<?php
include("../../bd.php");

if($_POST){

  // print_r($_POST);
  // print_r($_FILES); para ver si funciona si envia archivos


  $fecha=(isset($_POST['fecha']))?$_POST['fecha']:"";
  $titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
  $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
  $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";

  $fecha_imagen= new DateTime();
  $nombre_archivo_imagen=($imagen!="")? $fecha_imagen->getTimestamp()."_".$imagen:"";

  $tmp_imagen=$_FILES["imagen"]["tmp_name"];
  if($tmp_imagen!=""){
    move_uploaded_file($tmp_imagen,"../../../assets/img/about/".$nombre_archivo_imagen);
    }

  // echo $imagen;
  $sentencia=$conexion->prepare("INSERT INTO `tbl_entradas` (`id`, `fecha`, `titulo`, `imagen`, `descripcion`) VALUES (NULL, :fecha, :titulo, :imagen, :descripcion);");

    
    $sentencia->bindParam(":fecha",$fecha);
    $sentencia->bindParam(":titulo",$titulo);
    $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
    $sentencia->bindParam(":descripcion",$descripcion);

    $sentencia->execute();
 
    $mensaje="registro de servicio agregado con exito.";
    header("Location:index.php?mensaje=".$mensaje);

}




include("../../templates/headear.php");

?>

<div class="card">
  <div class="card-header">
    Entradas
  </div>
  <div class="card-body">

  <form action="" method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="fecha" class="form-label">Fecha:</label>
    <input type="date"
      class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="Fecha">
  </div>

  <div class="mb-3">
    <label for="titulo" class="form-label">Titulo:</label>
    <input type="text"
      class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo">
  </div>

  <div class="mb-3">
    <label for="descripcion" class="form-label">Descripcion:</label>
    <input type="text"
      class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="descripcion">
  </div>

  <div class="mb-3">
    <label for="imagen" class="form-label">Imagen:</label>
    <input type="file"
      class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="imagen">
  </div>

  <button type="submit" class="btn btn-success">Agregar</button>

  <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

  </form>
  


  </div>
  <div class="card-footer text-muted">
  </div>
</div>

<?php include("../../templates/footer.php");?>