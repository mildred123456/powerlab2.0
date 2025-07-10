<?php
include "../models/solicitudes.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitudes de contacto - PowerLab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../views/css/consulta_usuarios.css">
    <script>
        // Función para confirmar y redirigir al aceptar la solicitud
        function confirmarAceptar(id) {
            if (confirm("¿Estás seguro de aceptar esta solicitud?")) {
                window.location.href = `../controllers/aceptar_contacto.php?id=${id}`;
            }
        }

        // Función para confirmar y redirigir al rechazar la solicitud
        function confirmarRechazar(id) {
            if (confirm("¿Estás seguro de rechazar esta solicitud?")) {
                window.location.href = `../controllers/rechazar_contacto.php?id=${id}`;
            }
        }
    </script>
</head>
<body>
    <div class="container bg-white text-dark shadow-sm">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <span class="table-light">Solicitudes de contacto - PowerLab</span>
            </div>
            <div>
                <a href="instructor-inicio.php" class="btn btn-outline-secondary">← Volver</a>
            </div>
        </header>

        <table class="table table-striped table-hover">
            <thead class="text-warning">
                <tr>
                    <th>ID</th>
                    <th>Nombre del deportista</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($solicitudes)): ?>
                    <?php foreach ($solicitudes as $s): ?>
                        <tr>
                            <td><?= htmlspecialchars($s['id']) ?></td>
                            <td><?= htmlspecialchars($s['nombre']) ?></td>
                            <td><?= htmlspecialchars($s['fecha']) ?></td>
                            <td><?= ucfirst(htmlspecialchars($s['estado'])) ?></td>
                            <td>
                                <?php if ($s['estado'] === 'pendiente'): ?>
                                    <button type="button" class="btn btn-success btn-sm" onclick="confirmarAceptar(<?= $s['id'] ?>)">
                                        Aceptar
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmarRechazar(<?= $s['id'] ?>)">
                                        Rechazar
                                    </button>
                                <?php else: ?>
                                    <span class="text-muted">Solicitud <?= ucfirst(htmlspecialchars($s['estado'])) ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No hay solicitudes pendientes.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>