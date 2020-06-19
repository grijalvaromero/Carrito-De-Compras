<?php 
session_start();
include './php/conexion.php';
if(!isset($_SESSION['carrito'])){header("Location: ./index.php");} 
$arreglo  = $_SESSION['carrito'];
$total= 0;
for($i=0; $i<count($arreglo);$i++){
  $total = $total+($arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad']);
}
$password="";
if(isset($_POST['c_account_password'])){
    if($_POST['c_account_password']!=""){
        $password = $_POST['c_account_password'];
    }
}
$conexion->query("insert into usuario (nombre,telefono,email,password)  
  values( 
    '".$_POST['c_fname']." ".$_POST['c_lname']."',
    '".$_POST['c_phone']."',
    '".$_POST['c_email_address']."',
    '".sha1($password)."'
        )   
")or die($conexion->error);
$id_usuario = $conexion->insert_id;

$fecha = date('Y-m-d h:m:s');
$conexion -> query("insert into ventas(id_usuario,total,fecha) values($id_usuario,$total,'$fecha')")or die($conexion->error);
$id_venta = $conexion ->insert_id;

for($i=0; $i<count($arreglo);$i++){
  $conexion -> query("insert into productos_venta (id_venta,id_producto,cantidad,precio,subtotal) 
    values(
      $id_venta,
      ".$arreglo[$i]['Id'].",
      ".$arreglo[$i]['Cantidad'].",
      ".$arreglo[$i]['Precio'].",
      ".$arreglo[$i]['Cantidad']*$arreglo[$i]['Precio']."
      ) ")or die($conexion->error);
}

$conexion->query(" insert into envios(pais,company, direccion,estado,cp,id_venta) values
      (
        '".$_POST['country']."',
        '".$_POST['c_companyname']."',
        '".$_POST['c_address']."',
        '".$_POST['c_state_country']."',
        '".$_POST['c_postal_zip']."',
        $id_venta
      )  
      
      ")or die($conexion->error);
      
unset($_SESSION['carrito']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
   <title>Tienda</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body>
  
  <div class="site-wrap">
   <?php include("./layouts/header.php"); ?> 

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <span class="icon-check_circle display-3 text-success"></span>
            <h2 class="display-3 text-black">Thank you!</h2>
            <p class="lead mb-5">You order was successfuly completed.</p>
            <p><a href="shop.html" class="btn btn-sm btn-primary">Back to shop</a></p>
          </div>
        </div>
      </div>
    </div>

    <?php include("./layouts/footer.php"); ?> 

  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>