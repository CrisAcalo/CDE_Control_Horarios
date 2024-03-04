<?php

require_once 'Conexion.php';  // Asegúrate de incluir el archivo de conexión

class Materia
{
    public $nombre;
    public $correo;
    public $departamento;
    public $dedicacion;
    public $horas_semanales;
    public $created_at;

    public function __construct($nombre = "", $created_at = "")
    {
        $this->nombre = $nombre;
        $this->created_at = $created_at;
    }

    public function save()
    {
        global $conexion;  // Accede a la conexión global

        $sql = "INSERT INTO `materias`(`nombre`, `created_at`) 
        VALUES ('$this->nombre', '$this->created_at');";

        if ($conexion->query($sql)) {
            $conexion->close();
            return true; // Éxito al guardar
        } else {
            $errorDetails = $conexion->error;
            $conexion->close();
            return "Error al ejecutar la consulta: $errorDetails";
        }
    }

    public function getAll()
    {
        global $conexion;  // Accede a la conexión global

        $allData = [];

        $sql = "SELECT * FROM `materias` WHERE 1";

        $resultado = $conexion->query($sql);
        if($resultado->num_rows>0){
            while($row = $resultado->fetch_assoc()){
                $allData[]=$row;
            }
        }
        $conexion->close();
        return $allData;
    }
    public function deleteMateria($user_id)
    {
        global $conexion;  // Accede a la conexión global

        $sql = "DELETE FROM `materias` WHERE id = '$user_id'";

        if ($conexion->query($sql)) {
            $conexion->close();
            return true; // Éxito al guardar
        } else {
            $errorDetails = $conexion->error;
            $conexion->close();
            return "Error al ejecutar la consulta: $errorDetails";
        }
    }

    public function editMateria($materia_id)
    {
        global $conexion;  // Accede a la conexión global

        $sql = "UPDATE `materias` SET `nombre`='$this->nombre' WHERE `id` = '$materia_id'";

        if ($conexion->query($sql)) {
            $conexion->close();
            return true; // Éxito al guardar
        } else {
            $errorDetails = $conexion->error;
            $conexion->close();
            return $errorDetails;
        }
    }

    public function getProfesor($user_id)
    {
        global $conexion;  // Accede a la conexión global

        $sql = "SELECT `id`, `nombre`, `correo`, `departamento`, `dedicacion`, `horas_semanales`, `created_at` FROM `profesores` WHERE `id` = '$user_id'";

        $resultado = $conexion->query($sql);

        if ($resultado) {
            $conexion->close();
            // $resultado = json_encode($resultado);
            return $resultado->fetch_assoc();
        } else {
            $errorDetails = $conexion->error;
            $conexion->close();
            return "Error al ejecutar la consulta: $errorDetails";
        }
    }
}
