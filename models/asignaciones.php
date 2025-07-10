<?php
class asignaciones {

    public function REGISTRAR($id_deportista, $id_instructor, $tipo_asignacion, $contenido, $estado , $fecha_asignacion) {
        try {
            include "conexion.php";
    
            $insertar = $conexion->prepare("INSERT INTO asignaciones (id_deportista, id_instructor, tipo_asignacion, contenido, estado, fecha_asignacion) VALUES (?, ?, ?, ?, ?,?)");
            $insertar->execute([$id_deportista, $id_instructor, $tipo_asignacion, $contenido, $estado, $fecha_asignacion]);
    
            return true; // ✅ Solo confirmamos que se guardó
        } catch(Exception $e) {
            return $e;
        }
    }
    
public function ConsultaGeneral() {
    try {
        include "conexion.php";
        $validar = $conexion->prepare("
            SELECT a.id, u.nombre AS nombre_deportista, a.tipo_asignacion, a.contenido, a.estado, a.fecha_asignacion
            FROM asignaciones a
            INNER JOIN usuario u ON a.id_deportista = u.id
            ORDER BY a.fecha_asignacion DESC
        ");
        $validar->execute();
        return $validar->fetchAll(PDO::FETCH_NUM); // o FETCH_ASSOC si prefieres
    } catch (Exception $e) {
        return $e;
    }
}

public function ConsultaEspecifica($dato, $valor) {
    try {
        $permitidos = ['id_deportista'];
        if (!in_array($dato, $permitidos)) {
            throw new Exception("Campo no permitido en búsqueda.");
        }

        include "conexion.php";
        $sql = "
            SELECT a.id, u.nombre AS nombre_deportista, a.tipo_asignacion, a.contenido, a.estado, a.fecha_asignacion
            FROM asignaciones a
            INNER JOIN usuario u ON a.id_deportista = u.id
            WHERE a.$dato = ?
        ";
        $validar = $conexion->prepare($sql);
        $validar->execute([$valor]);
        return $validar->fetchAll(PDO::FETCH_NUM);
    } catch (Exception $e) {
        return $e;
    }
}


public function ACTUALIZAR($id, $contenido, $estado) {    
    try {
        include "conexion.php";

        $actualizar = $conexion->prepare("UPDATE asignaciones SET contenido=?, estado=?  WHERE id=?");
        $actualizar->execute([$contenido, $estado, $id]);

        // Si no se afectó ninguna fila, algo falló o se envió lo mismo
        if ($actualizar->rowCount() === 0) {
            return new Exception("No se modificó ninguna fila.");

        }      

        return true;
    } catch(Exception $e) {
        return $e;
    }
}

public function ELIMINAR($id) {
    try {
        include "conexion.php";
        $eliminar = $conexion->prepare("DELETE FROM asignaciones WHERE id = ?");
        $eliminar->execute([$id]);
        return true;
    } catch(Exception $e) {
        return $e;
    }
}
}



?>