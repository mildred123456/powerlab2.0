<?php

class SolicitudesContacto {
    // Crear una nueva solicitud de contacto
    public function crearSolicitud($id_usuario, $id_instructor) {
        try {
            include __DIR__ . "/conexion.php";
            $sql = "INSERT INTO solicitudes_contacto (id_usuario, id_instructor) VALUES (?, ?)";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$id_usuario, $id_instructor]);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    // Obtener todas las solicitudes de un instructor
    public function obtenerPorInstructor($id_instructor) {
        try {
            include __DIR__ . "/conexion.php";
            $sql = "SELECT s.id, s.id_usuario, u.nombre, s.estado, s.fecha
                    FROM solicitudes_contacto s
                    JOIN usuario u ON s.id_usuario = u.id
                    WHERE s.id_instructor = ?
                    ORDER BY s.fecha DESC";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$id_instructor]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return $e;
        }
    }

    // Actualizar estado de una solicitud (aceptar o rechazar)
    public function actualizarEstado($id, $estado) {
        try {
            include __DIR__ . "/conexion.php";
            $sql = "UPDATE solicitudes_contacto SET estado = ? WHERE id = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$estado, $id]);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }
}
