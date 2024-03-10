<?php

require_once 'Conexion.php';  // Asegúrate de incluir el archivo de conexión

class Periodo
{
    public $nombre;
    public $inicio;
    public $final;
    public $created_at;
    public $updated_at;

    public function __construct($nombre = "", $inicio = "", $final = "", $created_at = "", $updated_at = "")
    {
        $this->nombre = $nombre;
        $this->inicio = $inicio;
        $this->final = $final;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function save()
    {
        global $conexion;  // Accede a la conexión global

        $sql = "INSERT INTO `periodo_lectivo`(`name`, `periodo_inicio`, `periodo_fin`, `created_at`) 
        VALUES ('$this->nombre','$this->inicio','$this->final','$this->created_at');";
        $resultado = $conexion->query($sql);
        if ($resultado === TRUE) {
            $conexion->close();
            return $resultado; // Éxito al guardar
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

        $sql = "SELECT * FROM `periodo_lectivo` WHERE 1";

        $resultado = $conexion->query($sql);
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $allData[] = $row;
            }
        }
        $conexion->close();
        return $allData;
    }
    public function delete($user_id)
    {
        global $conexion;  // Accede a la conexión global

        $sql = "DELETE FROM `periodo_lectivo` WHERE id = '$user_id'";

        if ($conexion->query($sql)) {
            $conexion->close();
            return true; // Éxito al guardar
        } else {
            $errorDetails = $conexion->error;
            $conexion->close();
            return "Error al ejecutar la consulta: $errorDetails";
        }
    }

    public function edit($user_id)
    {
        global $conexion;  // Accede a la conexión global

        $sql = "UPDATE `periodo_lectivo` SET `name`='$this->nombre',`periodo_inicio`='$this->inicio',
                `periodo_fin`='$this->final',`updated_at`='$this->updated_at' WHERE `id` = '$user_id'";

        if ($conexion->query($sql)) {
            $conexion->close();
            return true; // Éxito al guardar
        } else {
            $errorDetails = $conexion->error;
            $conexion->close();
            return $errorDetails;
        }
    }

    public function getPeriodo($user_id)
    {
        global $conexion;  // Accede a la conexión global

        $sql = "SELECT `id`, `name`, `periodo_inicio`, `periodo_fin`, `created_at`, `updated_at` FROM `periodo_lectivo` WHERE `id` = '$user_id'";

        $resultado = $conexion->query($sql);

        if ($resultado) {
            $conexion->close();
            return $resultado->fetch_assoc();
        } else {
            $errorDetails = $conexion->error;
            $conexion->close();
            return "Error al ejecutar la consulta: $errorDetails";
        }
    }
}
