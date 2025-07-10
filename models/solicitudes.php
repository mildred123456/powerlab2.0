
<?php

class SolicitudesContacto {

    private $conexion;

    public function __construct() {
        include "conexion.php";
        $this->conexion = $conexion;
    }

    public function REGISTRAR($id_usuario, $id_instructor, $estado, $fecha) {
        try {
            $stmt = $this->conexion->prepare("INSERT INTO solicitudes_contacto (id_usuario, id_instructor, estado, fecha) VALUES (?, ?, ?, ?)");
            $stmt->execute([$id_usuario, $id_instructor, $estado, $fecha]);

            $id = $this->conexion->lastInsertId();
            $consulta = $this->conexion->prepare("SELECT * FROM solicitudes_contacto WHERE id = ?");
            $consulta->execute([$id]);
            return $consulta->fetch(PDO::FETCH_ASSOC);

        } catch(Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function consultaGeneral() {
        try {
            $stmt = $this->conexion->prepare("SELECT * FROM solicitudes_contacto");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function consultaEspecifica($campo, $valor) {
        try {
            $permitidos = ['id_usuario', 'id_instructor', 'estado', 'fecha'];
            if (!in_array($campo, $permitidos)) {
                throw new Exception("Campo no permitido en búsqueda.");
            }

            $sql = "SELECT * FROM solicitudes_contacto WHERE $campo = ?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([$valor]);
            return $stmt->fetchAll(PDO::FETCH_NUM);

        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function actualizar($estado, $id) {
        try {
            $stmt = $this->conexion->prepare("UPDATE solicitudes_contacto SET estado = ? WHERE id = ?");
            $stmt->execute([$estado, $id]);

            if ($stmt->rowCount() === 0) {
                return "No se modificó ninguna fila.";
            }

            return true;
        } catch(Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function eliminar($id) {
        try {
            $stmt = $this->conexion->prepare("UPDATE solicitudes_contacto SET estado = 'I' WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch(Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }


public function obtenerSolicitudesPorInstructor($id_instructor) {
    try {
        $sql = "SELECT * FROM solicitudes_contacto WHERE id_instructor = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$id_instructor]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
}
}
?>
