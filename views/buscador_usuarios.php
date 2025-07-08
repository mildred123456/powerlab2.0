<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Buscador de Usuarios</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Montserrat', sans-serif;
      padding: 2rem;
    }

    .form-select, .form-control {
      border-radius: 0.5rem;
    }

    .btn-warning {
      font-weight: 600;
    }

    .btn-outline-secondary {
      font-weight: 600;
    }
  </style>
</head>
<body>

  <form method="post" class="mb-4">
    <div class="row g-2 align-items-center">
      <div class="col-md-3">
        <select name="dato" class="form-select" required>
          <option value="nombre">Nombre</option>
          <option value="apellido">Apellido</option>
          <option value="correo">Correo</option>
          <option value="fecha_nacimiento">Fecha Nacimiento</option>
          <option value="genero">Género</option>
          <option value="rol">Rol</option>
        </select>
      </div>
      <div class="col-md-5">
        <input type="text" name="valor" class="form-control" placeholder="Buscar..." required>
      </div>
      <div class="col-md-4 d-flex gap-2">
        <button type="submit" class="btn btn-warning">Buscar</button>
        <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-outline-secondary">Limpiar</a>
      </div>
    </div>
  </form>

</body>
</html>
