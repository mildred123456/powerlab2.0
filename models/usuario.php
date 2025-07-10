<?php

class usuario {

    public function Login($correo, $contrasenia) {
        try {
            include "conexion.php";
            $consulta = $conexion->prepare("SELECT * FROM usuario WHERE correo = ? AND contrasenia = ? AND estado = 'A'");
            $consulta->execute([$correo, $contrasenia]);
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch(Exception $e) {
            return $e;
        }
    }

    public function REGISTRAR($nombre, $apellido, $correo, $fecha_nacimiento, $genero, $rol , $contrasenia) {
        try {
            include "conexion.php";
    
            // Insertar usuario
            $insertar = $conexion->prepare("INSERT INTO usuario (nombre, apellido, correo, fecha_nacimiento, genero, rol, estado, contrasenia) VALUES (?, ?, ?, ?, ?, ?, 'A', ?)");
            $insertar->execute([$nombre, $apellido, $correo, $fecha_nacimiento, $genero, $rol, $contrasenia]);
    
            // Consultar el usuario recién insertado
            $consulta = $conexion->prepare("SELECT * FROM usuario WHERE correo = ? ORDER BY id DESC LIMIT 1");
            $consulta->execute([$correo]);
            return $consulta->fetchAll(PDO::fetch(PDO::FETCH_ASSOC)); // Devuelve array para usar [0][0], [0][6]
        } catch(Exception $e) {
            return $e;
        }
    }


    public function ConsultaGeneral() {
        try {
            include "conexion.php";
            $validar = $conexion->prepare("SELECT * FROM usuario WHERE estado = 'A'");
            $validar->execute();
            return $validar->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $e) {
            return $e;
        }
    }
    
    public function ConsultaEspecifica($dato, $valor) {
        try {
            // Validación para evitar inyección SQL
            $permitidos = ['nombre', 'apellido', 'correo', 'fecha_nacimiento', 'genero', 'rol'];
            if (!in_array($dato, $permitidos)) {
                throw new Exception("Campo no permitido en búsqueda.");
            }
    
            include "conexion.php";
            $sql = "SELECT * FROM usuario WHERE $dato = ? AND estado = 'A'";
            $validar = $conexion->prepare($sql);
            $validar->execute([$valor]);
            return $validar->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function ACTUALIZAR($id, $nombre, $apellido, $correo, $fecha_nacimiento, $genero, $rol , $contrasenia  ) {
        try {
            include "conexion.php";
            $actualizar = $conexion->prepare("UPDATE usuario SET nombre=?, apellido=?, correo=?, fecha_nacimiento=?, genero=?, rol=?, contrasenia=? WHERE id=? ");
            $actualizar->execute([$nombre, $apellido, $correo, $fecha_nacimiento, $genero, $rol, $contrasenia, $id]);
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }


    public function ELIMINAR($id) {
        try {
            include "conexion.php";
            $eliminar = $conexion->prepare("UPDATE usuario SET estado = 'I' WHERE id = ?");
            $eliminar->execute([$id]);
            return $eliminar->rowCount() > 0;
        } catch(Exception $e) {
            error_log("Error al eliminar usuario: " . $e->getMessage());
            return false;
        }
    }
}

class instructor extends usuario {

    public function Login($correo, $contrasenia) {
        try {
            include "conexion.php";
            $consulta = $conexion->prepare("SELECT * FROM usuario WHERE correo = ? AND contrasenia = ? AND estado = 'A'");
            $consulta->execute([$correo, $contrasenia]);
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch(Exception $e) {
            return $e;
        }
    }

    public function REGISTRAR($nombre, $apellido, $correo, $fecha_nacimiento, $genero, $rol , $contrasenia) {
        try {
            include "conexion.php";
    
            // Insertar usuario
            $insertar = $conexion->prepare("INSERT INTO usuario (nombre, apellido, correo, fecha_nacimiento, genero, rol, estado, contrasenia) VALUES (?, ?, ?, ?, ?, ?, 'A', ?)");
            $insertar->execute([$nombre, $apellido, $correo, $fecha_nacimiento, $genero, $rol, $contrasenia]);
    
            // Consultar el usuario recién insertado
            $consulta = $conexion->prepare("SELECT * FROM usuario WHERE correo = ? ORDER BY id DESC LIMIT 1");
            $consulta->execute([$correo]);
            return $consulta->fetchAll(PDO::FETCH_NUM); // Devuelve array para usar [0][0], [0][6]
        } catch(Exception $e) {
            return $e;
        }
    }
    public function ConsultaGeneral() {
        try {
            include "conexion.php";
            $validar = $conexion->prepare("SELECT * FROM usuario WHERE estado = 'A'");
            $validar->execute();
            return $validar->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $e) {
            return $e;
        }
    }
    
    public function ConsultaEspecifica($dato, $valor) {
        try {
            // Validación para evitar inyección SQL
            $permitidos = ['nombre', 'apellido', 'correo', 'fecha_nacimiento', 'genero', 'rol'];
            if (!in_array($dato, $permitidos)) {
                throw new Exception("Campo no permitido en búsqueda.");
            }
    
            include "conexion.php";
            $sql = "SELECT * FROM usuario WHERE $dato = ? AND estado = 'A'";
            $validar = $conexion->prepare($sql);
            $validar->execute([$valor]);
            return $validar->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function ACTUALIZAR($id, $nombre, $apellido, $correo, $fecha_nacimiento, $genero, $rol , $contrasenia  ) {
        try {
            include "conexion.php";
            $actualizar = $conexion->prepare("UPDATE usuario SET nombre=?, apellido=?, correo=?, fecha_nacimiento=?, genero=?, rol=?, contrasenia=? WHERE id=? ");
            $actualizar->execute([$nombre, $apellido, $correo, $fecha_nacimiento, $genero, $rol, $contrasenia, $id]);
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }

    public function ELIMINAR($id) {
        try {
            include "conexion.php";
            $eliminar = $conexion->prepare("UPDATE usuario SET estado = 'I' WHERE id = ?");
            $eliminar->execute([$id]);
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }
}



class deportista extends usuario {

    public function Login($correo, $contrasenia) {
        try {
            include "conexion.php";
            $consulta = $conexion->prepare("SELECT * FROM usuario WHERE correo = ? AND contrasenia = ? AND estado = 'A'");
            $consulta->execute([$correo, $contrasenia]);
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch(Exception $e) {
            return $e;
        }
    }

public function REGISTRAR($nombre, $apellido, $correo, $fecha_nacimiento, $genero, $rol , $contrasenia) {
    try {
        include "conexion.php";

        // Insertar usuario
        $insertar = $conexion->prepare("INSERT INTO usuario (nombre, apellido, correo, fecha_nacimiento, genero, rol, estado, contrasenia) VALUES (?, ?, ?, ?, ?, ?, 'A', ?)");
        $insertar->execute([$nombre, $apellido, $correo, $fecha_nacimiento, $genero, $rol, $contrasenia]);

        // Consultar el usuario recién insertado
        $consulta = $conexion->prepare("SELECT * FROM usuario WHERE correo = ? ORDER BY id DESC LIMIT 1");
        $consulta->execute([$correo]);
        return $consulta->fetchAll(PDO::FETCH_NUM); // Devuelve array para usar [0][0], [0][6]
    } catch(Exception $e) {
        return $e;
    }
}
public function ConsultaGeneral() {
    try {
        include "conexion.php";
        $validar = $conexion->prepare("SELECT * FROM usuario WHERE estado = 'A'");
        $validar->execute();
        return $validar->fetchAll(PDO::FETCH_NUM);
    } catch (Exception $e) {
        return $e;
    }
}

public function ConsultaEspecifica($dato, $valor) {
    try {
        // Validación para evitar inyección SQL
        $permitidos = ['nombre', 'apellido', 'correo', 'fecha_nacimiento', 'genero', 'rol'];
        if (!in_array($dato, $permitidos)) {
            throw new Exception("Campo no permitido en búsqueda.");
        }

        include "conexion.php";
        $sql = "SELECT * FROM usuario WHERE $dato = ? AND estado = 'A'";
        $validar = $conexion->prepare($sql);
        $validar->execute([$valor]);
        return $validar->fetchAll(PDO::FETCH_NUM);
    } catch (Exception $e) {
        return $e;
    }
}


public function ELIMINAR($id) {
    try {
        include "conexion.php";
        $eliminar = $conexion->prepare("UPDATE usuario SET estado = 'I' WHERE id = ?");
        $eliminar->execute([$id]);
        return true;
    } catch(Exception $e) {
        return $e;
    }
}
}


class administrador extends usuario {

    public function Login($correo, $contrasenia) {
        try {
            include "conexion.php";
            $consulta = $conexion->prepare("SELECT * FROM usuario WHERE correo = ? AND contrasenia = ? AND estado = 'A'");
            $consulta->execute([$correo, $contrasenia]);
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch(Exception $e) {
            return $e;
        }
    }

    public function REGISTRAR($nombre, $apellido, $correo, $fecha_nacimiento, $genero, $rol , $contrasenia) {
        try {
            include "conexion.php";
    
            // Insertar usuario
            $insertar = $conexion->prepare("INSERT INTO usuario (nombre, apellido, correo, fecha_nacimiento, genero, rol, estado, contrasenia) VALUES (?, ?, ?, ?, ?, ?, 'A', ?)");
            $insertar->execute([$nombre, $apellido, $correo, $fecha_nacimiento, $genero, $rol, $contrasenia]);
    
            // Consultar el usuario recién insertado
            $consulta = $conexion->prepare("SELECT * FROM usuario WHERE correo = ? ORDER BY id DESC LIMIT 1");
            $consulta->execute([$correo]);
            return $consulta->fetchAll(PDO::FETCH_NUM); // Devuelve array para usar [0][0], [0][6]
        } catch(Exception $e) {
            return $e;
        }
    }
    public function ConsultaGeneral() {
        try {
            include "conexion.php";
            $validar = $conexion->prepare("SELECT * FROM usuario WHERE estado = 'A'");
            $validar->execute();
            return $validar->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $e) {
            return $e;
        }
    }
    
    public function ConsultaEspecifica($dato, $valor) {
        try {
            // Validación para evitar inyección SQL
            $permitidos = ['nombre', 'apellido', 'correo', 'fecha_nacimiento', 'genero', 'rol'];
            if (!in_array($dato, $permitidos)) {
                throw new Exception("Campo no permitido en búsqueda.");
            }
    
            include "conexion.php";
            $sql = "SELECT * FROM usuario WHERE $dato = ? AND estado = 'A'";
            $validar = $conexion->prepare($sql);
            $validar->execute([$valor]);
            return $validar->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function ACTUALIZAR($id, $nombre, $apellido, $correo, $fecha_nacimiento, $genero, $rol , $contrasenia  ) {
        try {
            include "conexion.php";
            $actualizar = $conexion->prepare("UPDATE usuario SET nombre=?, apellido=?, correo=?, fecha_nacimiento=?, genero=?, rol=?, contrasenia=? WHERE id=? ");
            $actualizar->execute([$nombre, $apellido, $correo, $fecha_nacimiento, $genero, $rol, $contrasenia, $id]);
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }

    
    public function ELIMINAR($id) {
        try {
            include "conexion.php";
            $eliminar = $conexion->prepare("UPDATE usuario SET estado = 'I' WHERE id = ?");
            $eliminar->execute([$id]);
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }
    }
    

    class nutricionista extends usuario {

        public function Login($correo, $contrasenia) {
            try {
                include "conexion.php";
                $consulta = $conexion->prepare("SELECT * FROM usuario WHERE correo = ? AND contrasenia = ? AND estado = 'A'");
                $consulta->execute([$correo, $contrasenia]);
                return $consulta->fetchAll(PDO::FETCH_ASSOC);
            } catch(Exception $e) {
                return $e;
            }
        }
    
        public function REGISTRAR($nombre, $apellido, $correo, $fecha_nacimiento, $genero, $rol , $contrasenia) {
            try {
                include "conexion.php";
        
                // Insertar usuario
                $insertar = $conexion->prepare("INSERT INTO usuario (nombre, apellido, correo, fecha_nacimiento, genero, rol, estado, contrasenia) VALUES (?, ?, ?, ?, ?, ?, 'A', ?)");
                $insertar->execute([$nombre, $apellido, $correo, $fecha_nacimiento, $genero, $rol, $contrasenia]);
        
                // Consultar el usuario recién insertado
                $consulta = $conexion->prepare("SELECT * FROM usuario WHERE correo = ? ORDER BY id DESC LIMIT 1");
                $consulta->execute([$correo]);
                return $consulta->fetchAll(PDO::FETCH_NUM); // Devuelve array para usar [0][0], [0][6]
            } catch(Exception $e) {
                return $e;
            }
        }
        public function ConsultaGeneral() {
            try {
                include "conexion.php";
                $validar = $conexion->prepare("SELECT * FROM usuario WHERE estado = 'A'");
                $validar->execute();
                return $validar->fetchAll(PDO::FETCH_NUM);
            } catch (Exception $e) {
                return $e;
            }
        }
        
        public function ConsultaEspecifica($dato, $valor) {
            try {
                // Validación para evitar inyección SQL
                $permitidos = ['nombre', 'apellido', 'correo', 'fecha_nacimiento', 'genero', 'rol'];
                if (!in_array($dato, $permitidos)) {
                    throw new Exception("Campo no permitido en búsqueda.");
                }
        
                include "conexion.php";
                $sql = "SELECT * FROM usuario WHERE $dato = ? AND estado = 'A'";
                $validar = $conexion->prepare($sql);
                $validar->execute([$valor]);
                return $validar->fetchAll(PDO::FETCH_NUM);
            } catch (Exception $e) {
                return $e;
            }
        }

        public function ACTUALIZAR($id, $nombre, $apellido, $correo, $fecha_nacimiento, $genero, $rol , $contrasenia  ) {
            try {
                include "conexion.php";
                $actualizar = $conexion->prepare("UPDATE usuario SET nombre=?, apellido=?, correo=?, fecha_nacimiento=?, genero=?, rol=?, contrasenia=? WHERE id=? ");
                $actualizar->execute([$nombre, $apellido, $correo, $fecha_nacimiento, $genero, $rol, $contrasenia, $id]);
                return true;
            } catch(Exception $e) {
                return $e;
            }
        }
    
        
        public function ELIMINAR($id) {
            try {
                include "conexion.php";
                $eliminar = $conexion->prepare("UPDATE usuario SET estado = 'I' WHERE id = ?");
                $eliminar->execute([$id]);
                return true;
            } catch(Exception $e) {
                return $e;
            }
        }
        }
        




        