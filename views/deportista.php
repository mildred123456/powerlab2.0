<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>deportista - PowerLab</title>
  <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="../views/css/usuarios.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
 
 
</head>

<body>
<?php
session_start();

if (!isset($_SESSION["usuario"])) {
  echo "<script>
  alert('!ups¡ Algo salio mal :( Verifique de nuevo la informacion, gracias.');
  location.href='../views/inicio-de-sesion.php';
</script>";
    exit();
}

$rol = $_SESSION["usuario"]["rol"];

if ($rol == "deportista") {
    include "../views/deportista-inicio.php";
} else if ($rol == "administrador") {
    include "../views/deportista-inicio.php";
} else if ($rol == "instructor") {
    include "../views/deportista-inicio.php";
} else {
  echo "<script>
  alert('!ups¡ Algo salio mal :( Verifique de nuevo la informacion, gracias.');
  location.href='../views/inicio-de-sesion.php';
</script>"; // Solo si el rol no coincide
    exit();
}

?>

<section class="container mt-4">
  <div class="accordion" id="accordionExample">
    
    <!-- CONSULTA DE USUARIOS -->
    <div class="bg-white text-dark shadow-sm">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
           Consulta de intructores
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <?php
            include "../views/buscador_instructores.php";
            echo "<hr>";
            include "../controllers/consulta_instructores.php";
          ?>
        </div>
      </div>
    </div>

  </div>
</section>



<footer>
  PowerLab © 2025 - Todos los derechos reservados
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>