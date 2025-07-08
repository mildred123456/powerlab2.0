<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Usuarios - PowerLab</title>
  <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
  <link href="../css/usuarios.css" rel="stylesheet" />
 
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

if ($rol == "administrador") {
    include "../views/administrador-inicio.php";
} else if ($rol == "deportista") {
    include "../views/deportista-inicio.php";
} else if ($rol == "instructor") {
    include "../views/instructor-inicio.php";
}  else if ($rol == "nutricionista") {
    include "../views/nutricionista-inicio.php";
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
    <div class="accordion-item bg-dark text-white">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
           Consulta de Usuarios
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <?php
            include "../views/buscador_pacientes.php";
            echo "<hr>";
            include "../controllers/consulta_pacientes.php";
          ?>
        </div>
      </div>
    </div>

    <!-- REGISTRO DE USUARIOS -->
    <div class="accordion-item bg-dark text-white">
      <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
            Registro de planes
        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <?php include "../views/planes.html"; ?>
        </div>
      </div>
    </div>

  </div>
</section>

<footer>
  PowerLab © 2025 - Todos los derechos reservados
</footer>

</body>
</html>
