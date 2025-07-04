<?php
include_once(__DIR__ . '/../models/usuario.php');

$objeto = new rutinas();
$respuesta = $objeto->ACTUALIZAR($_POST["id"], $_POST["titulo"], $_POST["descripcion"], $_POST["nivel"], $_POST["dias_por_semana"]);
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