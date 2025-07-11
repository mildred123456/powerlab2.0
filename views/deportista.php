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
  <div class="card shadow-sm rounded-4 border-0 overflow-hidden">
    <div class="row g-0">

      <!-- COLUMNA IZQUIERDA: TEXTO Y BOTÓN -->
      <div class="col-md-7 p-4">
        <h4 class="card-title mb-3">Instructores disponibles</h4>
        <p class="card-text">Aquí puedes consultar y contactar instructores activos y más en PowerLab.</p>
        <button class="btn btn-primary rounded-pill" onclick="toggleInstructores()">Ver instructores disponibles</button>

        <div id="contenedorInstructores" class="mt-4" style="display: none;">
          <?php
            include "../views/buscador_instructores.php";
            echo "<hr>";
            include "../controllers/consulta_instructores.php";
          ?>
        </div>
      </div>

      <!-- COLUMNA DERECHA: IMAGEN -->
      <div class="col-md-5 text-center p-3 d-flex align-items-start justify-content-center">
        <img src="https://i.pinimg.com/736x/38/1a/80/381a8009c5da504598e6f42e145b364d.jpg" 
             alt="Instructores disponibles" 
             class="img-fluid rounded-3 mt-2"
             style="max-height: 200px; object-fit: contain;">
      </div>

    </div>
  </div>
</section>

<script>
  function toggleInstructores() {
    const contenedor = document.getElementById("contenedorInstructores");
    contenedor.style.display = (contenedor.style.display === "none") ? "block" : "none";
  }
</script>


<?php
              include "../views/footer.html";
              
            ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>