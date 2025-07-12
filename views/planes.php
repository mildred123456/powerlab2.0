<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Nutricionista - PowerLab</title>
  <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
  <style>
    body {
      background: linear-gradient(135deg, #f9f9f9, #ffffff);
      font-family: 'Montserrat', sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .container {
      flex: 1;
    }
    footer {
      background-color: #fff;
      text-align: center;
      padding: 1rem;
      border-top: 1px solid #e5e5e5;
      font-size: 0.9rem;
      color: #666;
    }
  </style>
</head>

<body>

<?php
session_start();

if (!isset($_SESSION["usuario"])) {
  echo "<script>
  alert('¡Ups! Algo salió mal :( Verifica la información, gracias.');
  location.href='../views/inicio-de-sesion.php';
</script>";
  exit();
}

$rol = $_SESSION["usuario"]["rol"];

if ($rol == "administrador") {
    include "../views/administrador-inicio.php";
} else if ($rol == "nutricionista") {
    include "../views/nutricionista-inicio.php";
} else {
  echo "<script>
  alert('¡Ups! Acceso no autorizado.');
  location.href='../views/inicio-de-sesion.php';
</script>";
  exit();
}
?>

<section class="container mt-5 animate__animated animate__fadeInUp text-center">

  <!-- Consulta de Usuarios -->
  <div class="card shadow-sm rounded-4 border-0 mb-4 p-4">
    <h4 class="fw-bold mb-2">Consulta de Pacientes</h4>
    <p class="text-muted">Aquí puedes buscar y consultar los pacientes registrados para seguimiento nutricional.</p>
    <button class="btn btn-outline-primary rounded-pill" onclick="togglePacientes()">👥 Ver pacientes</button>

    <div id="contenedorPacientes" class="mt-4" style="display: none;">
      <div class="card shadow-sm rounded-4 border-0 p-4 text-start">
        <?php
          include "../views/buscador_pacientes.php";
          echo "<hr>";
          include "../controllers/consulta_pacientes.php";
        ?>
      </div>
    </div>
  </div>

  <!-- Registro de planes -->
  <div class="card shadow-sm rounded-4 border-0 p-4">
    <h4 class="fw-bold mb-2">Registro de Planes Nutricionales</h4>
    <p class="text-muted">Desde aquí puedes registrar y asignar nuevos planes nutricionales a los pacientes.</p>
    <button class="btn btn-outline-success rounded-pill" onclick="togglePlanes()">📝 Registrar plan</button>

    <div id="contenedorPlanes" class="mt-4" style="display: none;">
      <div class="card shadow-sm rounded-4 border-0 p-4 text-start">
        <?php include "../views/planes.html"; ?>
      </div>
    </div>
  </div>

</section>

<footer>
  PowerLab © 2025 - Todos los derechos reservados
</footer>

<script>
  function togglePacientes() {
    const contenedor = document.getElementById("contenedorPacientes");
    contenedor.style.display = (contenedor.style.display === "none") ? "block" : "none";
  }

  function togglePlanes() {
    const contenedor = document.getElementById("contenedorPlanes");
    contenedor.style.display = (contenedor.style.display === "none") ? "block" : "none";
  }
</script>

</body>
</html>
