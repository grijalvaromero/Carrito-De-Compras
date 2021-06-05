<?php 
  session_start();
  include "../php/conexion.php";
  if(!isset($_SESSION['datos_login'])){
    header("Location: ../index.php");
  }
  $arregloUsuario = $_SESSION['datos_login'];
  if($arregloUsuario['nivel']!= 'admin'){ 
    header("Location: ../index.php");
  }   
  $resultado = $conexion ->query("
    select * from cupones 
    order by id DESC")or die($conexion->error);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="./dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="./dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="./dashboard/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dashboard/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="./dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="./dashboard/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="./dashboard/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include "./layouts/header.php";?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Productos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              <i class="fa fa-plus"></i> Crear Cupon
            </button>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
      
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          
          <?php 
            if(isset($_GET['error'])){
          ?>
            <div class="alert alert-danger" role="alert">
            <?php echo $_GET['error'];?>
            </div>

          <?php  }?>
          <?php 
            if(isset($_GET['success'])){
          ?>
            <div class="alert alert-success" role="alert">
              Se ha insertado correctamente.
            </div>

          <?php  }?>
          <table class="table">
            <thead>
              <tr>
                <th>Id</th>
                <th>Codigo</th>
                <th>Status</th>
                <th>Tipo</th>
                <th>Valor</th>
                <th>Fecha de Vencimiento</th>
                <th></th>
              </tr>
             
            </thead>
            <tbody>
             
                  <?php 
                    while($f = mysqli_fetch_array($resultado)){
                  ?>
                   <tr>
                      <td><?php echo $f['id'];?></td>
                      <td>
                       
                        <?php echo $f['codigo'];?>
                      </td>
                      <td><?php echo $f['status'];?></td>
                      <td><?php echo $f['tipo'];?></td>
                      <td><?php echo $f['valor'];?></td>
                      <td><?php echo $f['fecha_vencimiento'];?></td>
                      <td>
                       
                        <button class="btn btn-danger btn-small btnEliminar"  
                          data-id="<?php echo $f['id']; ?>"
                          data-toggle="modal" data-target="#modalEliminar">
                          <i class="fa fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                <?php
                   }
                ?>
            </tbody>
          </table>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="../php/insertarcupon.php" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Crear Cupon</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                  <label for="nombre">Codigo</label>
                  <div class="row">
                   <div class="col-9">
                    <input type="text" name="codigo" placeholder="codigo" id="codigo" class="form-control" required>
                   </div>
                   <div class="col-3">
                   <button class="btn btn-primary btn-small col-12" id="generar">Generar</button>
                   </div>
                  </div>
                 
              </div>
              <div class="form-group">
                  <label for="tipo">Tipo</label>
                 <select name="tipo" id="tipo" class="form-control">
                   <option value="moneda">Moneda</option>
                   <option value="porcentaje">Porcentaje</option>
                 </select>
              </div>
             
              <div class="form-group">
                  <label for="valor">Valor del cupon</label>
                  <input type="number" min="0" name="valor" placeholder="valor" id="valor" class="form-control" required>
              </div>
              <div class="form-group">
                  <label for="fecha">Fecha de Vencimiento</label>
                  <input type="date" min="0" name="fecha" placeholder="fecha" id="fecha" class="form-control" required>
              </div>
             
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div> 
    <!-- Modal Eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
         
            <div class="modal-header">
              <h5 class="modal-title" id="modalEliminarLabel">Eliminar Producto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                ¿Desea eliminar el producto?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger eliminar" data-dismiss="modal">Eliminar</button>
            </div>
         
        </div>
      </div>
    </div>   
   <!-- Modal Editar -->
   <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditar" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="../php/editarproducto.php" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditar">Editar Producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <input type="hidden" id="idEdit" name="id">
             
              <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="nombreEdit" name="nombre" placeholder="nombre" id="nombreEdit" class="form-control" required>
              </div>
              <div class="form-group">
                  <label for="descripcionEdit">Descripcion</label>
                  <input type="text" name="descripcion" placeholder="descripcion" id="descripcionEdit" class="form-control" required>
              </div>
              <div class="form-group">
                  <label for="imagen">Imagen</label>
                  <input type="file" name="imagen"  id="imagen" class="form-control">
              </div>
              <div class="form-group">
                  <label for="precioEdit">Precio</label>
                  <input type="number" min="0" name="precio" placeholder="precio" id="precioEdit" class="form-control" required>
              </div>
              <div class="form-group">
                  <label for="inventarioEdit">Inventario</label>
                  <input type="number" min="0" name="inventario" placeholder="inventarioEdit" id="inventarioEdit" class="form-control" required>
              </div>
              <div class="form-group">
                  <label for="categoriaEdit">Caetegoria</label>
                  <select name="categoria" id="categoriaEdit" class="form-control" required>
                   <?php 
                    $res= $conexion->query("select * from categorias");
                    while($f=mysqli_fetch_array($res)){
                      echo '<option value="'.$f['id'].'" >'.$f['nombre'].'</option>';
                    }
                   ?>
                  </select> 
              </div>
              <div class="form-group">
                  <label for="tallaEdit">Talla</label>
                  <input type="text" name="talla" placeholder="talla" id="tallaEdit" class="form-control" required>
              </div>
              <div class="form-group">
                  <label for="tallaEdit">Color</label>
                  <input type="text" name="color" placeholder="color" id="colorEdit" class="form-control" required>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary editar">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div> 
  <?php include "./layouts/footer.php";?>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="./dashboard/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="./dashboard/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="./dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="./dashboard/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="./dashboard/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="./dashboard/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="./dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="./dashboard/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="./dashboard/plugins/moment/moment.min.js"></script>
<script src="./dashboard/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="./dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="./dashboard/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="./dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="./dashboard/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="./dashboard/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./dashboard/dist/js/demo.js"></script>

<script>
  $(document).ready(function(){
    var idEliminar= -1;
    var idEditar=-1;
    var fila;
    $("#generar").click(function(){
        var num = Math.floor( Math.random()*90000)+10000;
        $("#codigo").val(num);
    });
    $(".btnEliminar").click(function(){
      idEliminar= $(this).data('id');
      fila=$(this).parent('td').parent('tr');
    });
    $(".eliminar").click(function(){
      $.ajax({
        url: '../php/eliminarproducto.php',
        method:'POST',
        data:{
          id:idEliminar
        }
      }).done(function(res){

        $(fila).fadeOut(1000);
      });
     
    });
    $(".btnEditar").click(function(){
      idEditar=$(this).data('id');
      var nombre=$(this).data('nombre');
      var descripcion=$(this).data('descripcion');
      var inventario=$(this).data('inventario');
      var categoria=$(this).data('categoria');
      var talla=$(this).data('talla');
      var color=$(this).data('color');
      var precio=$(this).data('precio');
      $("#nombreEdit").val(nombre);
      $("#descripcionEdit").val(descripcion);
      $("#inventarioEdit").val(inventario);
      $("#categoriaEdit").val(categoria);
      $("#tallaEdit").val(talla);
      $("#colorEdit").val(color);
      $("#precioEdit").val(precio);
      $("#idEdit").val(idEditar);
    });
  });

</script>
</body>
</html>
