<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Deportista - PowerLab</title>
  <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="/css/index.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #fefefe;
    }

    .welcome-title {
      text-align: center;
      font-size: 2rem;
      margin-top: 2rem;
      color: #444;
    }

    .card-magica {
      width: 24rem;
      background-color: #fff9db;
      border-radius: 1.25rem;
      box-shadow: 0 4px 16px rgba(255,193,7,0.3);
      border: none;
      animation-duration: 1.5s;
    }

    .card-magica .card-header {
      background-color: #ffeaa7;
      color: #6c4c00;
      font-weight: bold;
      font-size: 1.2rem;
      border-bottom: none;
      border-radius: 1.25rem 1.25rem 0 0;
    }

    .card-magica .btn {
      transition: all 0.3s ease;
    }

    .card-magica .btn:hover {
      transform: scale(1.05);
      box-shadow: 0 0 10px #ffc107;
    }
  </style>
</head>

<body>

  <!-- Header -->
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

  <!-- Bienvenida -->
  <h1 class="welcome-title animate__animated animate__fadeInDown"> ¡Bienvenido, Deportista!</h1>

  <!-- TARJETA FIJA ABAJO -->
<div id="rutinaCard" class="position-fixed bottom-0 start-50 translate-middle-x mb-4 animate__animated animate__fadeInUp" style="z-index: 1050; transition: opacity 0.5s ease; display: block;">
  <div class="card card-magica shadow">
    <div class="card-header text-center d-flex justify-content-between align-items-center">
      <span> ¡Tienes nuevas rutinas!</span>
      <button type="button" class="btn-close" aria-label="Cerrar" onclick="cerrarTarjetaRutina()" style="filter: invert(1);"></button>
    </div>
    <div class="card-body text-center">
      <p class="card-text mb-3">Consulta las rutinas que tu instructor ha preparado especialmente para ti.</p>
      <a href="error500.html" class="btn btn-outline-warning fw-bold px-4 rounded-pill">Ver mis rutinas</a>
    </div>
  </div>
</div>

<!-- BOTÓN PARA VOLVER A MOSTRAR -->
<div class="position-fixed bottom-0 end-0 me-4 mb-4" style="z-index: 1050;">
  <button class="btn btn-warning rounded-pill shadow fw-bold" onclick="mostrarTarjetaRutina()">Mostrar rutinas</button>
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

</body>
</html>
