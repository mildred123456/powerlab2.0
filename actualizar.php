<?php
include "../models/usuario.php";

$objeto = new administrador();
$respuesta = $objeto->ACTUALIZAR($_POST["id"], $_POST["nombre"], $_POST["apellido"], $_POST["correo"], $_POST["fecha_nacimiento"], $_POST["genero"], $_POST["rol"],$_POST["contrasenia"]);

if($respuesta instanceof Exception){
    if($respuesta->getCode()==23000)
    {
        echo "<script>
                alert('valor imposible de duplicar');
                location.href='../views/usuarios.php';        
        </script>";
    }
    else{
        echo "<script>
                alert('valor imposible de duplicar');        
        </script>";
    }
}
else{
    echo "<script>
                alert('Registro actualizado correctamente');
                location.href='../views/usuarios.php';        
        </script>";
}

?>

