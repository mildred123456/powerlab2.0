<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>


</head>
<body>
<form method="post" class="mb-4">
  <div class="row g-2">
    <div class="col-auto">
      <select name="dato" class="form-select">
        <option value="nombre">Nombre</option>
        <option value="apellido">Apellido</option>
        <option value="correo">Correo</option>
        <option value="fecha_nacimiento">Fecha Nacimiento</option>
        <option value="genero">Género</option>
        <option value="rol">Rol</option>
      </select>
    </div>
    <div class="col">
      <input type="text" name="valor" class="form-control" placeholder="Buscar..." required>
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-warning">Buscar</button>
      <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-outline-light">Limpiar</a>
    </div>
  </div>
</form>


</body>
</html>
<?php
