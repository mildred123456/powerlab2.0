<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio Nutricionista - PowerLab</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #000;
      color: #fff;
      overflow-x: hidden;
      min-height: 100vh;
    }
    .navbar {
      background-color: rgba(0, 0, 0, 0.85);
      border-bottom: 2px solid #fff;
    }
    .navbar a {
      color: white;
      transition: color 0.3s ease;
    }
    .navbar a:hover {
      color: orange;
    }
    .card-custom {
      background-color: #111;
      border: 1px solid #333;
      color: #fff;
    }
    .card-custom .btn {
      border-radius: 20px;
      font-weight: bold;
    }
    .btn-info {
      background-color: rgba(255, 165, 0, 0.9);
      border: none;
    }
    .btn-info:hover {
      transform: scale(1.05);
      background-color: rgba(255, 180, 20, 0.95);
    }
    .info-box {
      background-color: rgba(255, 165, 0, 0.1);
      border: 1px solid rgba(255,165,0,0.2);
      color: #ffae00;
    }
    .bg-section {
      background-color: #111;
      padding: 2rem;
      border-radius: 15px;
    }
    footer {
      border-top: 1px solid #444;
    }
  </style>
</head>
<body>
  <!-- Navbar estilo PowerLab -->
  <nav class="navbar navbar-expand-lg navbar-dark px-4">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center text-white" href="#">
        <img src="../imagenes/logopower.png" alt="Logo" style="height: 50px; margin-right: 15px;">
        PowerLab
      </a>
      <div class="d-flex align-items-center ms-auto">
        <a href="#" class="text-white mx-3 text-decoration-none">Inicio</a>
        <a href="#" class="text-white mx-3 text-decoration-none">Pacientes</a>
        <a href="#" class="text-white mx-3 text-decoration-none">Perfil</a>
      </div>
    </div>
  </nav>

  <!-- Contenido principal -->
  <main class="container my-5">
    <div class="row g-4">
      <div class="col-lg-8">
        <div class="card card-custom p-4 rounded-4 shadow-sm mb-4">
          <h3 class="fs-5 mb-3">Panel de Nutricionista</h3>
          <p class="text-secondary">Gestiona planes alimenticios, haz seguimiento de los hábitos de tus pacientes y acompáñalos en su progreso.</p>
          <button class="btn btn-info text-white me-2">Ver Planes Nutricionales</button>
          <button class="btn btn-outline-light">Editar Perfil</button>
        </div>

        <div class="info-box p-4 rounded-4 mt-4">
          <p><strong>Consejo:</strong> La clave está en la constancia. Ajusta los planes según el progreso del paciente.</p>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="bg-section mb-3">
          <h5 class="mb-3">Progreso general de pacientes</h5>
          <p>80% han cumplido sus metas de alimentación este mes.</p>
        </div>
        <div>
          <img src="../imagenes/plan-nutricion.jpg" alt="Plan Nutricional" class="img-fluid rounded-3 mt-3">
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="text-center text-secondary py-4">
    © 2025 PowerLab. Todos los derechos reservados.
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>