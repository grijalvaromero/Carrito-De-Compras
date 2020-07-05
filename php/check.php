<?php 
session_start();
include "./conexion.php";

if(  isset($_POST['email'])  && isset($_POST['password'])   ){
    
    $resultado = $conexion->query("select * from usuario where 
        email='".$_POST['email']."' and 
        password='".sha1($_POST['password'])."' limit 1")or die($conexion->error);
    if(mysqli_num_rows($resultado)>0){
        $datos_usuario = mysqli_fetch_row($resultado); 
        $nombre = $datos_usuario[1];
        $id_usuario = $datos_usuario[0];
        $email = $datos_usuario[3];
        $imagen_perfil = $datos_usuario[5];
        $nivel = $datos_usuario[6];

        $_SESSION['datos_login']= array(
            'nombre'=>$nombre,
            'id_usuario'=>$id_usuario,
            'email'=>$email,
            'imagen'=>$imagen_perfil,
            'nivel'=>$nivel
        );
        header("Location: ../admin/");
    }else{
        header("Location: ../login.php?error=Credenciales incorrectas");
    }



}else{
    header("../login.php");
}



?>