<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Iniciar Sesión - PowerLab</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f8f9fa;
      color: #212529;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .navbar {
      background-color: #ffffff !important;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .navbar a {
      color: #212529 !important;
    }

    #contenedor {
      flex: 1 0 auto;
      padding: 60px 15px;
    }

    .form-control {
      border-radius: 0.5rem;
    }

    .btn {
      padding: 10px 30px;
      font-weight: 600;
    }

    footer {
      flex-shrink: 0;
      background-color: #ffffff;
      border-top: 1px solid #dee2e6;
      color: #6c757d;
    }

    @media (max-width: 768px) {
      header img {
        width: 100%;
      }

      section {
        border: none !important;
        margin-top: 2rem;
      }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg px-4">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="../imagenes/logopower.png" alt="Logo" style="height: 70px; margin-right: 35px;">
      </a>
      <div class="d-flex align-items-center ms-auto">
        <a href="#" class="mx-3 text-decoration-none">Ayuda</a>
        <a href="#" class="mx-3 text-decoration-none">Planes</a>
        <a href="#" class="mx-3 text-decoration-none">Promociones</a>
      </div>
    </div>
  </nav>

  <!-- Contenido -->
  <div class="container text-center" id="contenedor">
    <div class="row align-items-center">
      <header class="col-md-6 mb-3 mb-md-0">
        <img src="../imagenes/logopower.png" width="60%" alt="Logo de PowerLab">
      </header>
      <section class="col-md-6 border-start border-secondary">
        <form action="../controllers/login.php" method="POST">
          <div class="form-floating mb-3">
            <input required name="correo" type="email" maxlength="50" class="form-control" id="floatingInput" placeholder="name@example.com" autofocus>
            <label for="floatingInput">Correo electrónico</label>
          </div>

          <div class="form-floating">
            <input required name="contrasenia" type="password" maxlength="35" class="form-control" id="contrasenia" placeholder="Contraseña">
            <label for="contrasenia">Contraseña</label>
          </div>

          <div class="mt-4">
            <button type="submit" class="btn btn-warning">Ingresar</button>
          </div>
        </form>
      </section>
    </div>
  </div>

  <!-- Footer -->
  <footer class="text-center text-muted border-top py-3">
    © 2025 Powerlab. Todos los derechos reservados.
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
    const popoverList = [...popoverTriggerList].map(el => new bootstrap.Popover(el));
  </script>
</body>
</html>
