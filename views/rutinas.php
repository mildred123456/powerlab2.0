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
  <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
    <div class="row g-0">
      
      <!-- COLUMNA IZQUIERDA: TEXTO Y BOTÓN -->
      <div class="col-md-7 p-4">
        <h3 class="fw-bold mb-2">Gestion de deportistas y rutinas</h3>
        <p class="text-muted">Busca y gestiona los deportistas y rutinas registradas en PowerLab de manera sencilla.</p>
        <button class="btn btn-outline-primary rounded-pill" onclick="toggleDeportistas()">
           Ver deportistas
        </button>

        <div id="contenedorDeportistas" class="mt-4" style="display: none;">
          <?php
            include "../views/buscador-deportistas.php";
            echo "<hr>";
            include "../controllers/consulta_deportistas.php";
          ?>
        </div>
      </div>

      <!-- COLUMNA DERECHA: IMAGEN AJUSTADA ARRIBA -->
      <div class="col-md-5 text-center p-3 d-flex align-items-start justify-content-center">
        <img src="https://i.pinimg.com/736x/7a/62/de/7a62dee5a38b704de99b20dea56e17ae.jpg"
             alt="Consulta de deportistas"
             class="img-fluid rounded-3 mt-2"
             style="max-height: 200px; object-fit: contain;">
      </div>

    </div>
  </div>
</section>

<script>
  function toggleDeportistas() {
    const contenedor = document.getElementById("contenedorDeportistas");
    contenedor.style.display = (contenedor.style.display === "none") ? "block" : "none";
  }
</script>



<!-- TARJETA FIJA ABAJO -->
<div id="rutinaCard" class="position-fixed bottom-0 start-50 translate-middle-x mb-4 animate__animated animate__fadeInUp" style="z-index: 1050; transition: opacity 0.5s ease; display: block;">
  <div class="card card-magica shadow">
    <div class="card-header text-center d-flex justify-content-between align-items-center">
      <span> ¡ver solicitudes!</span>
      <button type="button" class="btn-close" aria-label="Cerrar" onclick="cerrarTarjetaRutina()" style="filter: invert(1);"></button>
    </div>
    <div class="card-body text-center">
      <p class="card-text mb-3">Consulta que deportistas quieren que tu seas parte de su proseso</p>
      <a href="ver-solicitudes.php" class="btn btn-outline-warning fw-bold px-4 rounded-pill">Ver solicitudes</a>
    </div>
  </div>
</div>

<!-- BOTÓN PARA VOLVER A MOSTRAR -->
<div class="position-fixed bottom-0 end-0 me-4 mb-4" style="z-index: 1050;">
  <button class="btn btn-warning rounded-pill shadow fw-bold" onclick="mostrarTarjetaRutina()">Mostrar solicitudes</button>
</div>

<!-- SCRIPT -->
<script>
  function cerrarTarjetaRutina() {
    const card = document.getElementById('rutinaCard');
    card.classList.remove('animate__fadeInUp');
    card.classList.add('animate__fadeOutDown');

    setTimeout(() => {
      card.style.display = 'none';
    }, 700);
  }

  function mostrarTarjetaRutina() {
    const card = document.getElementById('rutinaCard');
    card.style.display = 'block';
    card.classList.remove('animate__fadeOutDown');
    card.classList.add('animate__fadeInUp');
  }
</script>
<?php
              include "../views/footer.html";
              
            ?>

</body>
</html>
