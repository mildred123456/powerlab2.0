<?php
session_start();

$id_deportista = $_GET['id_deportista'] ?? null;
$id_instructor = $_SESSION['usuario']['id'] ?? null;

if (!$id_deportista || !$id_instructor) {
    die("Faltan datos necesarios.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Asignar Rutina</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f9fafb;
      font-family: 'Segoe UI', sans-serif;
    }
    .form-container {
      max-width: 600px;
      margin: 60px auto;
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .btn-custom {
      background-color: #0d6efd;
      color: white;
    }
    .btn-custom:hover {
      background-color: #084298;
    }
  </style>
</head>
<body>

<div class="form-container">
  <h3 class="mb-4">Asignar rutina al deportista #<?= htmlspecialchars($id_deportista) ?></h3>

  <form action="../controllers/registro-asignacion.php" method="POST">
    <!-- Campos ocultos automáticos -->
    <input type="hidden" name="id_deportista" value="<?= $id_deportista ?>">
    <input type="hidden" name="id_instructor" value="<?= $id_instructor ?>">
    <input type="hidden" name="tipo_asignacion" value="rutina">

    <!-- Campo visible: contenido -->
    <div class="mb-3">
      <label for="contenido" class="form-label">Contenido de la rutina</label>
      <textarea name="contenido" class="form-control" required placeholder="Ej: Cardio, abdominales, peso muerto..."></textarea>
    </div>

    <div class="d-flex justify-content-between">
      <button type="submit" class="btn btn-warning">Guardar asignación</button>
      <a href="consulta_asignaciones.php" class="btn btn-outline-secondary">Cancelar</a>
    </div>
  </form>
</div>

</body>
</html>
