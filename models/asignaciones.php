<?php
class Asignacion {

    // 📌 Crear una nueva asignación (rutina o reporte)
    public function asignar($id_instructor, $id_deportista, $tipo_asignacion, $contenido) {
        try {
            include "conexion.php";
            $sql = "INSERT INTO asignaciones 
                    (id_instructor, id_deportista, tipo_asignacion, contenido, estado, fecha_asignacion)
                    VALUES (?, ?, ?, ?, 'pendiente', NOW())";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$id_instructor, $id_deportista, $tipo_asignacion, $contenido]);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    // 📌 Obtener asignaciones de un deportista
    public function obtenerPorDeportista($id_deportista) {
        try {
            include "conexion.php";
            $sql = "SELECT a.*, u.nombre AS nombre_instructor 
                    FROM asignaciones a
                    INNER JOIN usuario u ON a.id_instructor = u.id
                    WHERE a.id_deportista = ?
                    ORDER BY a.fecha_asignacion DESC";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$id_deportista]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return $e;
        }
    }

    // 📌 Obtener asignaciones realizadas por un instructor
    public function obtenerPorInstructor($id_instructor) {
        try {
            include "conexion.php";
            $sql = "SELECT a.*, u.nombre AS nombre_deportista 
                    FROM asignaciones a
                    INNER JOIN usuario u ON a.id_deportista = u.id
                    WHERE a.id_instructor = ?
                    ORDER BY a.fecha_asignacion DESC";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$id_instructor]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return $e;
        }
    }

    // 📌 Marcar una asignación como realizada
    public function marcarRealizado($id_asignacion) {
        try {
            include "conexion.php";
            $sql = "UPDATE asignaciones SET estado = 'realizado' WHERE id = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$id_asignacion]);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }
}
