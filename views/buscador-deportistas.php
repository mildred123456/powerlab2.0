<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Buscar usuarios</title>

  <!-- Bootstrap + Animate.css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

 

</head>

<body>

<div class="container mt-5">
  <div class="form-busqueda animate__animated animate__fadeInUp">
    <form method="post">
      <div class="row g-3 align-items-center">
        <div class="col-md-3">
          <select name="dato" class="form-select" required>
            <option value="nombre">Nombre</option>
            <option value="apellido">Apellido</option>
            <option value="correo">Correo</option>
            <option value="genero">Género</option>
          </select>
        </div>

        <div class="col-md-5">
          <input type="text" name="valor" class="form-control" placeholder="Buscar..." required />
        </div>

        <div class="col-md-4 d-flex gap-2">
          <button type="submit" class="btn btn-warning px-4"> Buscar</button>
          <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-outline-secondary px-4">Limpiar</a>
        </div>
      </div>
    </form>
  </div>
</div>

</body>
</html>
