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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <style>
    body {
      background-color: #fefefe;
      font-family: 'Montserrat', sans-serif;
    }

    .accordion .accordion-button {
      font-weight: bold;
      font-size: 1.1rem;
      background-color: #fff9db;
      color: #6c4c00;
    }

    .accordion .accordion-body {
      background: #fff;
      border-radius: 0 0 1rem 1rem;
      box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.03);
      padding: 2rem;
    }

    .accordion-item {
      border: none;
      margin-bottom: 1rem;
      border-radius: 1rem;
      overflow: hidden;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    footer {
      background-color: #fff9db;
      border-top: 2px solid #ffeaa7;
      text-align: center;
      padding: 2rem 1rem;
      font-size: 0.9rem;
      color: #6c4c00;
    }
  </style>
</head>

<body>

<?php
session_start();

if (!isset($_SESSION["usuario"])) {
  echo "<script>
  alert('¡Ups! Algo salió mal :( Verifica la información.');
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
} else {
  echo "<script>
  alert('¡Ups! Algo salió mal :( Verifica la información.');
  location.href='../views/inicio-de-sesion.php';
  </script>";
  exit();
}
?>

<section class="container mt-5 animate__animated animate__fadeInUp">
  <div class="accordion" id="accordionExample">
    
    <!-- CONSULTA DE USUARIOS -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
           Consulta de Usuarios
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <?php
            include "../views/buscador_usuarios.php";
            echo "<hr>";
            include "../controllers/consulta_usuarios.php";
          ?>
        </div>
      </div>
    </div>

    <!-- REGISTRO DE USUARIOS -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
           Registro de Usuarios
        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <?php include "../views/registros.html"; ?>
        </div>
      </div>
    </div>

  </div>
</section>

<?php
              include "../views/footer.html";
              
            ?>

</body>
</html>
