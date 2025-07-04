<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión - PowerLab</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/inicio-de-sesion.css">
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-negro border-bottom border-white px-4">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center text-white" href="#">
        <img src="../imagenes/logopower.png" alt="Logo" style="height: 50px; margin-right: 15px;">
      </a>
      <div class="d-flex align-items-center ms-auto">
        <a href="#" class="text-white mx-3 text-decoration-none">Ayuda</a>
        <a href="#" class="text-white mx-3 text-decoration-none">Planes</a>
        <a href="#" class="text-white mx-3 text-decoration-none">Promociones</a>
      </div>
    </div>
  </nav>

  <div class="container text-center" id="contenedor">
    <div class="row align-items-center">
      <header class="col-md-6 mb-3 mb-md-0">
        <img src="../imagenes/logopower.png" width="60%" alt="Escudo del colegio">
      </header>
      <section class="col-md-6 border-start border-secondary">
        <form action="../controllers/login.php" method="POST">
          <div class="form-floating mb-3">
            <input required name="correo" type="email" maxlength="50" class="form-control" id="floatingInput" placeholder="name@example.com" autofocus>
            <label for="floatingInput">Correo electrónico</label>
          </div>



          <div class="form-floating">
            <input required name="contrasenia" type="password" maxlength="35" class="form-control" id="contrasenia" placeholder="Password">
            <label for="floatingPassword">Contraseña</label>
          </div>

          
          <div class="mt-4">
            <button type="submit" class="btn btn-outline-primary">Ingresar</button>
          </div>
        </form>
      </section>
    </div>
  </div>

  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
    const popoverList = [...popoverTriggerList].map(el => new bootstrap.Popover(el));
  </script>
  <footer class="bg-black border-top border-light text-center text-secondary py-3 mt-auto">
    <div class="container">
      <small>© 2025 Powerlab. Todos los derechos reservados.</small>
    </div>
  </footer>
</body>
</html>