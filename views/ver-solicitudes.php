
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<section class="bg-white border-bottom">
    <div class="container text-center py-3">
      <div class="row align-items-center">
        <div class="col-4 text-start">
          <img src="../imagenes/logopower.png" alt="Logo" style="height: 60px;">
        </div>
        <div class="col-8">
          <nav class="nav nav-pills justify-content-end">
            <a class="nav-link" href="#">Tienda</a>
            <a class="nav-link" href="#">Rutinas</a>
            <a class="nav-link" href="#">Configuración</a>
            <a class="nav-link text-danger" href="../controllers/logout.php">Salir</a>
          </nav>
        </div>
      </div>
    </div>
  </section>
    <?php
  include "../views/buscador-asignaciones.php";
  echo "<hr>";
  include "../controllers/consulta_solicitudes.php";

    ?>
</body>
</html>