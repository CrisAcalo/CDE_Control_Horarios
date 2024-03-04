<?php

require_once '../Model/Materia.php'; // Ajusta la ruta según tu estructura de archivos
$funcion = $_GET["function"];
if ($funcion == "createMateria") {
    createMateria();
} else if ($funcion == "mostrarDatos") {
    mostrarDatos();
} else if ($funcion == "deleteMateria") {
    deleteMateria();
} else if ($funcion == "editMateria") {
    editMateria();
} else if ($funcion == "getProfesor") {
    getProfesor();
}else{
    echo 'Error en el Controlador';
}

function createMateria()
{
    $dateAct = date('Y/m/d h:i:s', time());

    // Obtener los datos JSON enviados por la solicitud
    $data = json_decode(file_get_contents("php://input"));

    // Crear una instancia de Materia con los datos recibidos
    $profesor = new Materia($data->nombre, $dateAct);

    $result = $profesor->save();

    // Enviar una respuesta basada en el resultado
    if ($result === true) {
        echo "Success: Materia guardada correctamente.";
    } else {
        echo "Error: Error al guardar el profesor. Detalles: " . $result;
    }
}

function mostrarDatos()
{
    $materias = new Materia();
    $allMaterias = $materias->getAll();
    echo json_encode($allMaterias);
}

function deleteMateria()
{
    $user_id = $_GET["user_id"];
    $materia = new Materia();
    $result = $materia->deleteMateria($user_id);

    // Enviar una respuesta basada en el resultado
    if ($result === true) {
        echo "Success: Materia eliminada correctamente.";
    } else {
        echo "Error: Error al eliminar la materia. Detalles: " . $result;
    }
}

function getProfesor()
{
    $response = [
        "status" => "",
        "response" => ""
    ];
    $user_id = $_GET["user_id"];
    $profesor = new Profesor();
    $result = $profesor->getProfesor($user_id);
    // echo $result;
    // Enviar una respuesta basada en el resultado
    if ($result) {
        $response["status"] = "Success";
        $response["response"] = $result;
        echo json_encode($response);
    } else {
        $response["status"] = "Error";
        $response["response"] = "Error: Error al traer información del profesor. Detalles: " . $result;
        echo json_encode($response);
    }
}

function editMateria()
{
    $response = [
        "status" => "",
        "response" => ""
    ];
    $materia_id = $_GET["materia_id"];

    $data = json_decode(file_get_contents("php://input"));

    $materia = new Materia($data->nombre);
    $result = $materia->editMateria($materia_id);

    // Enviar una respuesta basada en el resultado
    if ($result == true) {
        $response["status"] = "Success";
        $response["response"] = "Materia editada correctamente";
        echo json_encode($response);
    } else {
        $response["status"] = "Error";
        $response["response"] = "Error al editar la materia. Detalles: " . $result;
        echo json_encode($response);
    }
}
