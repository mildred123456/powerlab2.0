<?php
include "../models/asignaciones.php";

$objeto = new asignaciones ();
$respuesta = $objeto->ACTUALIZAR($_POST["id"],$_POST["contenido"], $_POST["estado"]);

if($respuesta instanceof Exception){
  if($respuesta->getCode()==23000)
  {
      echo "<script>
              alert('valor imposible de duplicar');
              location.href='../views/rutinas.php';        
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
              location.href='../views/rutinas.php';        
      </script>";
}
      

?>