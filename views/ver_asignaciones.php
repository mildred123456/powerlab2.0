<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Asignaciones - PowerLab</title>
  <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">

  <!-- Bootstrap y Montserrat -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />

  <!-- Animación opcional -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <style>
    body {
      background-color: #fefefe;
      font-family: 'Montserrat', sans-serif;
    }

    .accordion-button {
      background-color: #fff9db;
      font-weight: 600;
      color: #6c4c00;
    }

    .accordion-button:focus {
      box-shadow: none;
    }

    .accordion-body {
      background-color: #ffffff;
      padding: 2rem;
      border-radius: 0 0 1rem 1rem;
    }

    .accordion-item {
      border-radius: 1rem;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
      overflow: hidden;
      margin-bottom: 1rem;
    }

    footer {
      background-color: #fff9db;
      border-top: 2px solid #ffeaa7;
      text-align: center;
      padding: 1rem;
      font-size: 0.9rem;
      color: #6c4c00;
    }
  </style>
</head>
<body>

<section class="container mt-5 animate__animated animate__fadeInUp">
  <div class="accordion" id="accordionExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
           Consulta de asignaciones
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <?php
            include "../views/buscador-asignaciones.php";
            echo "<hr>";
            include "../controllers/consultar-asignaciones-deportista.php";
          ?>
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
