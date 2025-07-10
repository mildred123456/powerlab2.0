<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<section class="container mt-4">
      <div class="accordion" id="accordionExample">
    <div class="accordion-item bg-dark text-white">
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

    
    
</section>
 
</body>
</html>
