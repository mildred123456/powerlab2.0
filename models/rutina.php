<?php

class rutinas {

public function REGISTRAR($titulo, $descripcion, $nivel, $dias_por_semana, $id_instructor, $nombre) {
    try {
        include "conexion.php";

        $insertar = $conexion->prepare("INSERT INTO rutinas (titulo, descripcion, nivel, dias_por_semana, id_instructor, nombre) VALUES (?, ?, ?, ?, ?, ?)");
        $insertar->execute([$titulo, $descripcion, $nivel, $dias_por_semana, $id_instructor, $nombre]);

        $consultar = $conexion->prepare("SELECT * FROM rutinas");
        $consultar->execute();
        return $consultar->fetchAll(PDO::FETCH_ASSOC); 

    } catch(Exception $e) {
        return $e;
    }
}

public function ConsultaGeneral() {
    try {
        include "conexion.php";
        $validar = $conexion->prepare("SELECT * FROM rutinas WHERE estado = 'A'");
        $validar->execute();
        return $validar->fetchAll(PDO::FETCH_NUM);
    } catch (Exception $e) {
        return $e;
    }
}

public function ConsultaEspecifica($dato, $valor) {
    try {
        $permitidos = ['titulo', 'descripcion', 'nivel', 'dias_por_semana', 'id_instructor', 'nombre'];
        if (!in_array($dato, $permitidos)) {
            throw new Exception("Campo no permitido en búsqueda.");
        }

        include "conexion.php";
        $sql = "SELECT * FROM rutinas WHERE $dato = ?";
        $validar = $conexion->prepare($sql);
        $validar->execute([$valor]);
        return $validar->fetchAll(PDO::FETCH_NUM);
    } catch (Exception $e) {
        return $e;
    }
}

public function ACTUALIZAR($id, $titulo, $descripcion, $nivel, $dias_por_semana) {
    try {
        include "conexion.php";

        $actualizar = $conexion->prepare("UPDATE rutinas SET titulo=?, descripcion=?, nivel=?, dias_por_semana=? WHERE id_rutina=?");
        $actualizar->execute([$titulo, $descripcion, $nivel, $dias_por_semana, $id]);

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
        $eliminar = $conexion->prepare("UPDATE rutinas SET estado = 'I' WHERE id = ?");
        $eliminar->execute([$id]);
        return true;
    } catch(Exception $e) {
        return $e;
    }
}
}



?>