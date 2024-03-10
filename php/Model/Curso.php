<?php

require_once 'Conexion.php';  // Asegúrate de incluir el archivo de conexión

class Curso
{
    public $nrc;
    public $profesor_id;
    public $materia_id;
    public $departamento_id;
    public $carrera_id;
    public $periodo_id;

    public function __construct($nrc = "", $profesor_id = "", $materia_id = "", $departamento_id = "", $carrera_id = "", $periodo_id = "")
    {
        $this->nrc = $nrc;
        $this->profesor_id = $profesor_id;
        $this->materia_id = $materia_id;
        $this->departamento_id = $departamento_id;
        $this->carrera_id = $carrera_id;
        $this->periodo_id = $periodo_id;
    }

    public function save()
    {
        global $conexion;  // Accede a la conexión global

        $sql = "INSERT INTO `cursos`(`NRC`,`profesor_id`, `materia_id`, `departamento_id`, `carrera_id`, `periodo_id`) 
        VALUES ('$this->nrc','$this->profesor_id','$this->materia_id','$this->departamento_id','$this->carrera_id','$this->periodo_id');";

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
        $rowData = [];

        $sql = "SELECT * FROM `cursos` WHERE 1";

        $resultado = $conexion->query($sql);
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $rowData = [];
                $sqlProfesor = "SELECT * FROM `profesores` WHERE `id` = " . $row["profesor_id"];
                $sqlMateria = "SELECT * FROM `materias` WHERE `id` = " . $row["materia_id"];
                $sqlDepartamento = "SELECT * FROM `departamentos` WHERE `id` = " . $row["departamento_id"];
                $sqlCarrera = "SELECT * FROM `carreras` WHERE `id` = " . $row["carrera_id"];
                $sqlPeriodo = "SELECT * FROM `periodo_lectivo` WHERE `id` = " . $row["periodo_id"];

                $profesor = $conexion->query($sqlProfesor);
                $materia = $conexion->query($sqlMateria);
                $departamento = $conexion->query($sqlDepartamento);
                $carrera = $conexion->query($sqlCarrera);
                $periodo = $conexion->query($sqlPeriodo);

                $profesor = $profesor->fetch_assoc();
                $materia = $materia->fetch_assoc();
                $departamento = $departamento->fetch_assoc();
                $carrera = $carrera->fetch_assoc();
                $periodo = $periodo->fetch_assoc();

                $rowData['profesor'] = [$profesor];
                $rowData['materia'] = [$materia];
                $rowData['departamento'] = [$departamento];
                $rowData['carrera'] = [$carrera];
                $rowData['periodo'] = [$periodo];

                $allData[] = [
                    'id' => $row["id"],
                    'nrc' => $row["NRC"],
                    'data' => $rowData,
                ];
            }
        }

        $conexion->close();
        return $allData;
    }
    public function deleteC($user_id)
    {
        global $conexion;  // Accede a la conexión global

        $sql = "DELETE FROM `cursos` WHERE id = '$user_id'";

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

        $sql = "UPDATE `cursos` SET `NRC`='$this->nrc',`profesor_id`='$this->profesor_id',`materia_id`='$this->materia_id',`departamento_id`='$this->departamento_id',
        `carrera_id`='$this->carrera_id',`periodo_id`='$this->periodo_id' WHERE `id` = '$user_id'";

        if ($conexion->query($sql)) {
            $conexion->close();
            return true; // Éxito al guardar
        } else {
            $errorDetails = $conexion->error;
            $conexion->close();
            return $errorDetails;
        }
    }

    public function getC($user_id)
    {
        global $conexion;  // Accede a la conexión global

        $sql = "SELECT  `id`,  `NRC`, `profesor_id`, `materia_id`, `departamento_id`, `carrera_id`, `periodo_id`, `created_at`, `updated_at` FROM `cursos` WHERE `id` = '$user_id'";

        $resultado = $conexion->query($sql);

        $resultado = $conexion->query($sql);
        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            $rowData = [];
            $sqlProfesor = "SELECT * FROM `profesores` WHERE `id` = " . $row["profesor_id"];
            $sqlMateria = "SELECT * FROM `materias` WHERE `id` = " . $row["materia_id"];
            $sqlDepartamento = "SELECT * FROM `departamentos` WHERE `id` = " . $row["departamento_id"];
            $sqlCarrera = "SELECT * FROM `carreras` WHERE `id` = " . $row["carrera_id"];
            $sqlPeriodo = "SELECT * FROM `periodo_lectivo` WHERE `id` = " . $row["periodo_id"];

            $profesor = $conexion->query($sqlProfesor);
            $materia = $conexion->query($sqlMateria);
            $departamento = $conexion->query($sqlDepartamento);
            $carrera = $conexion->query($sqlCarrera);
            $periodo = $conexion->query($sqlPeriodo);

            $profesor = $profesor->fetch_assoc();
            $materia = $materia->fetch_assoc();
            $departamento = $departamento->fetch_assoc();
            $carrera = $carrera->fetch_assoc();
            $periodo = $periodo->fetch_assoc();

            $rowData['id'] = $row['id'];
            $rowData['nrc'] = $row['NRC'];
            $rowData['profesor'] = [$profesor];
            $rowData['materia'] = [$materia];
            $rowData['departamento'] = [$departamento];
            $rowData['carrera'] = [$carrera];
            $rowData['periodo'] = [$periodo];
        }

        if ($resultado) {
            $conexion->close();
            // $resultado = json_encode($resultado);
            return $rowData;
        } else {
            $errorDetails = $conexion->error;
            $conexion->close();
            return "Error al ejecutar la consulta: $errorDetails";
        }
    }
}
