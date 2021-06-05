<?php
include "./php/conexion.php";
if(!isset($_GET['id_venta'])){
    header("Location: ./");
}
$datos = $conexion->query("select 
        ventas.*,  
        usuario.nombre,usuario.telefono,usuario.email
        from ventas 
        inner join usuario on ventas.id_usuario = usuario.id
        where ventas.id=".$_GET['id_venta'])or die($conexion->error);
$datosUsuario = mysqli_fetch_row($datos);
$datos2 = $conexion->query("select * from envios where id_venta=".$_GET['id_venta'])or die($conexion->error);
$datosEnvio= mysqli_fetch_row($datos2);

$datos3= $conexion->query("select productos_venta.*,    
                productos.nombre as nombre_producto, productos.imagen 
                from productos_venta inner join productos on productos_venta.id_producto = productos.id 
                where id_venta =".$_GET['id_venta'])or die($conexion->error);

$total = $datosUsuario[2];
$descuento = "0";
$banderadescuento = false;

if($datosUsuario[6] != 0){
  $banderadescuento = true;
  $cupon= $conexion->query("select  * from cupones where id =".$datosUsuario[6]);
  $filaCupon  = mysqli_fetch_row($cupon);
  if($filaCupon[3] == "moneda"){
    $total = $total - $filaCupon[4];
    $descuento =$filaCupon[4]."MXN";
  }else{
    $total = $total - ($total * ( $filaCupon[4] / 100 ));
    $descuento =$filaCupon[4]."%";
  }
 
}


// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';

// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-XXXXXXXXXXXXXXXXX');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();
$preference->back_urls = array(
    "success" => "https://localhost/carrito/thankyou.php?id_venta=".$_GET['id_venta']."&metodo=mercado_pago",
    "failure" => "https://localhost/carrito/errorpago.php?error=failure",
    "pending" => "https://localhost/carrito/errorpago.php?error=pending"
);
$preference->auto_return = "approved";
// Crea un ítem en la preferencia

$datos=array();
if($banderadescuento){
  $item = new MercadoPago\Item();
  $item->title = "Productos de mi tienda.com  menos el descuento";
  $item->quantity = 1;
  $item->unit_price =$total;
  $datos[]=$item;
}else{
  while($f = mysqli_fetch_array($datos3)){
    $item = new MercadoPago\Item();
    $item->title = $f['nombre_producto'];;
    $item->quantity = $f['cantidad'];;
    $item->unit_price =$f['precio'];;
    $datos[]=$item;
  }
}



$preference->items = $datos;
$preference->save();

//curl -X POST -H "Content-Type: application/json" "https://api.mercadopago.com/users/test_user?access_token=TESTXXXXXX" -d "{'site_id':'MLM'}"
//{"id":6000000,"nickname":"TESTMIU1O9BO","password":"qatest3577","site_status":"active","email":"test_user_19@testuser.com"} //vendedor
//{"id":6000555,"nickname":"TESTTH2CVX3Y","password":"qatest5953","site_status":"active","email":"test_user_61@testuser.com"} //comprador
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <title>Elige metodo de pago</title>
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
<script 
    src="https://www.paypal.com/sdk/js?client-id=TUTOKENNNNf&currency=MXN"> // Replace YOUR_SB_CLIENT_ID with your sandbox client ID
  </script>
    
  <div class="site-wrap">
  <?php include("./layouts/header.php"); ?> 

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="h3 mb-3 text-black">Elige metodo de pago</h2>
          </div>
          <div class="col-md-7">

            <form action="#" method="post">
              
              <div class="p-3 p-lg-5 border">
                
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_fname" class="text-black">Venta #<?php echo $_GET['id_venta'];?></label>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_fname" class="text-black">Nombre <?php echo $datosUsuario[4];?></label>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_fname" class="text-black">Email <?php echo $datosUsuario[6];?></label>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_fname" class="text-black">Telefono <?php echo $datosUsuario[5];?></label>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_fname" class="text-black">Company <?php echo $datosEnvio[2];?></label>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_fname" class="text-black">Direccion <?php echo $datosEnvio[3];?></label>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_fname" class="text-black">Direccion <?php echo $datosEnvio[4];?></label>
                  </div>
                </div>
                
              </div>
            </form>
          </div>
          <div class="col-md-5 ml-auto">
            <h4 class="h1">Total: <?php echo $datosUsuario[2];?></h4>
            <h5>Descuento: <?php  echo $descuento;  ?></h5>
            <h5>Total Final <?php  echo $total;  ?></h5>
            <form action="http://localhost/carrito/thankyou.php?id_venta=<?php echo $_GET['id_venta']?>&metodo=mercado_pago" method="POST">
                <h2>Mercado pago</h2>
                <script
                src="https://www.mercadopago.com.mx/integrations/v1/web-payment-checkout.js"
                data-preference-id="<?php echo $preference->id; ?>">
                </script>
            </form>
            <div id="paypal-button-container"></div>
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
  <script>
      paypal.Buttons({
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '<?php  echo $total;  ?>',
                

              },
              
            }]
          });
        },
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
             
            if(details.status == 'COMPLETED'){
               location.href="./thankyou.php?id_venta=<?php echo $_GET['id_venta'];?>&metodo=paypal";
            }
           
          });
        }
      }).render('#paypal-button-container'); // Display payment options on your web page
    </script>      

</body>
</html>