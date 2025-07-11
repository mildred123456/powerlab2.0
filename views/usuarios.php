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
    img:hover {
  transform: scale(1.05);
  transition: 0.3s ease-in-out;
  box-shadow: 0 0 15px rgba(0,0,0,0.2);
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

<section class="container mt-5 animate__animated animate__fadeInUp text-center">

  <!--  CONSULTA DE USUARIOS -->
  <div class="mb-5">
    <div class="position-relative d-inline-block" onclick="toggleUsuarios()" style="cursor: pointer;">
      <img src="https://i.pinimg.com/736x/41/3a/51/413a51a5a89c36f8ab5d7b2824223855.jpg" 
           alt="Consulta de usuarios"
           class="img-fluid"
           style="max-width: 200px;">
      <div class="position-absolute top-50 start-50 translate-middle bg-white bg-opacity-75 px-3 py-2 rounded-pill shadow">
        <strong>Consulta de Usuarios</strong>
      </div>
    </div>

    <div id="contenedorUsuarios" class="mt-4" style="display: none;">
      <div class="card shadow-sm rounded-4 border-0 p-4 text-start">
        <?php
          include "../views/buscador_usuarios.php";
          echo "<hr>";
          include "../controllers/consulta_usuarios.php";
        ?>
      </div>
    </div>
  </div>

  <!--  REGISTRO DE USUARIOS -->
  <div>
    <div class="position-relative d-inline-block" onclick="toggleRegistro()" style="cursor: pointer;">
      <img src="https://i.pinimg.com/736x/85/52/b2/8552b27681bd0181dd158962b4812b09.jpg" 
           alt="Registro de usuarios"
           class="img-fluid"
           style="max-width: 200px;">
      <div class="position-absolute top-50 start-50 translate-middle bg-white bg-opacity-75 px-3 py-2 rounded-pill shadow">
        <strong>Registro de Usuarios</strong>
      </div>
    </div>

    <div id="contenedorRegistro" class="mt-4" style="display: none;">
      <div class="card shadow-sm rounded-4 border-0 p-4 text-start">
        <?php include "../views/registros.html"; ?>
      </div>
    </div>
  </div>

</section>

<script>
  function toggleUsuarios() {
    const contenedor = document.getElementById("contenedorUsuarios");
    contenedor.style.display = (contenedor.style.display === "none") ? "block" : "none";
  }

  function toggleRegistro() {
    const contenedor = document.getElementById("contenedorRegistro");
    contenedor.style.display = (contenedor.style.display === "none") ? "block" : "none";
  }
</script>




<?php
              include "../views/footer.html";
              
            ?>

</body>
</html>
