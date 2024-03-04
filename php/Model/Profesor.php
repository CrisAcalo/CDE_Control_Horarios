<?php

require_once 'Conexion.php';  // Asegúrate de incluir el archivo de conexión

class Profesor
{
    public $nombre;
    public $correo;
    public $departamento;
    public $dedicacion;
    public $horas_semanales;
    public $created_at;

    public function __construct($nombre = "", $correo = "", $departamento = "", $dedicacion = "", $horas_semanales = 0, $created_at = "")
    {
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->departamento = $departamento;
        $this->dedicacion = $dedicacion;
        $this->horas_semanales = $horas_semanales;
        $this->created_at = $created_at;
    }

    public function save()
    {
        global $conexion;  // Accede a la conexión global

        $sql = "INSERT INTO `profesores`(`nombre`, `correo`, `departamento`, `dedicacion`, `horas_semanales`, `created_at`) 
        VALUES ('$this->nombre','$this->correo','$this->departamento','$this->dedicacion','$this->horas_semanales','$this->created_at');";

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

        $sql = "SELECT * FROM `profesores` WHERE 1";

        $resultado = $conexion->query($sql);
        if($resultado->num_rows>0){
            while($row = $resultado->fetch_assoc()){
                $allData[]=$row;
            }
        }
        $conexion->close();
        return $allData;
    }
    public function deleteProfesor($user_id)
    {
        global $conexion;  // Accede a la conexión global

        $sql = "DELETE FROM `profesores` WHERE id = '$user_id'";

        if ($conexion->query($sql)) {
            $conexion->close();
            return true; // Éxito al guardar
        } else {
            $errorDetails = $conexion->error;
            $conexion->close();
            return "Error al ejecutar la consulta: $errorDetails";
        }
    }

    public function editProfesor($user_id)
    {
        global $conexion;  // Accede a la conexión global

        $sql = "UPDATE `profesores` SET `nombre`='$this->nombre',`correo`='$this->correo',`departamento`='$this->departamento',`dedicacion`='$this->dedicacion',`horas_semanales`='$this->horas_semanales' WHERE `id` = '$user_id'";

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
