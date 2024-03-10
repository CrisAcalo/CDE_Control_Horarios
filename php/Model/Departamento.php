<?php

require_once 'Conexion.php';  // Asegúrate de incluir el archivo de conexión

class Departamento
{
    public function getAll()
    {
        global $conexion;  // Accede a la conexión global

        $allData = [];

        $sql = "SELECT * FROM `departamentos` WHERE 1";

        $resultado = $conexion->query($sql);
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $allData[] = $row;
            }
        }
        $conexion->close();
        return $allData;
    }

    public function getData($user_id)
    {
        global $conexion;  // Accede a la conexión global

        $sql = "SELECT `id`, `name` FROM `departamentos` WHERE `id` = '$user_id'";

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

    public function getCareersByDepartment($id)
    {
        global $conexion;

        $allData = [];

        $sql = "SELECT * FROM `carreras` WHERE `departamento_id` = '$id';";

        $resultado = $conexion->query($sql);
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $allData[] = $row;
            }
        }
        $conexion->close();
        return $allData;
    }
}
