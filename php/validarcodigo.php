<?php 
include "conexion.php";

if(isset($_POST['codigo'])){
    $respuesta = $conexion ->query("select * from cupones where codigo ='".$_POST['codigo']."' ");
    if(mysqli_num_rows($respuesta) == 0){
        echo "codigo no valido";
    }else{
        $datos = mysqli_fetch_row($respuesta);
        if($datos[2] == 'activo'){
            $arreglo = array(
                'id' => $datos[0],
                'codigo' => $datos[1],
                'status' => $datos[2],
                'tipo' => $datos[3],
                'valor' => $datos[4],
                'fecha_vencimiento' => $datos[5],
                );
                echo json_encode($arreglo);
        }else{
            echo "error";
        }
       
    }

}else{
    echo "error";
}

?>