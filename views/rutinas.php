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
  <link href="../css/usuarios.css" rel="stylesheet" />

  <style>
    body {
      background-color: #fefefe;
      font-family: 'Montserrat', sans-serif;
    }

    footer {
      text-align: center;
      padding: 1rem;
      margin-top: 2rem;
      background: #f7f7f7;
      font-size: 0.9rem;
      color: #555;
    }

    .powerlab-card {
      background: #fff;
      border-radius: 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      padding: 2rem;
    }

    .accordion-button {
      font-weight: bold;
      font-size: 1.1rem;
    }

    .btn-outline-primary {
      font-weight: 600;
      border-radius: 2rem;
      margin-bottom: 1rem;
    }

    .btn-outline-primary:hover {
      background-color: #0d6efd;
      color: #fff;
    }
  </style>
</head>

<body>

<?php
session_start();

if (!isset($_SESSION["usuario"])) {
  echo "<script>
    alert('¡Ups! Algo salió mal :( Verifica de nuevo la información.');
    location.href='../views/inicio-de-sesion.php';
  </script>";
  exit();
}

$rol = $_SESSION["usuario"]["rol"];

if ($rol == "instructor") {
    include "../views/instructor-inicio.php";
} else if ($rol == "deportista") {
    include "../views/deportista-inicio.php";
} else if ($rol == "administrador") {
    include "../views/administrador-inicio.php";
} else {
  echo "<script>
    alert('¡Ups! Algo salió mal :( Verifica de nuevo la información.');
    location.href='../views/inicio-de-sesion.php';
  </script>";
  exit();
}
?>

<section class="container mt-4 animate__animated animate__fadeInUp">
  <div class="powerlab-card">
    <a href="../views/ver-solicitudes.php" class="btn btn-outline-primary">📩 Ver solicitudes de contacto</a>

    <div class="accordion mt-3" id="accordionExample">
      <div class="accordion-item border-0 shadow-sm">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
             Consulta de deportistas
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <?php
              include "../views/buscador-deportistas.php";
              echo "<hr>";
              include "../controllers/consulta_deportistas.php";
            ?>
          </div>
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
