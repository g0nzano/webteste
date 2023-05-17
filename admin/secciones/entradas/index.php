<?php
 include("../../bd.php");
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
          <tr class="">
            <td>1</td>
            <td>06-04-2023</td>
            <td>Inicia empresa</td>
            <td>Yo inicie la empresa para yo</td>
            <td>imagen.jpg</td>
            <td> Editar | Borrar </td>
          </tr>
        </tbody>
      </table>
    </div>
    
  </div>
  <div class="card-footer text-muted">
   
  </div>
</div>

<?php include("../../templates/footer.php");?>
