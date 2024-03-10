<?php

require_once '../Model/Curso.php'; // Ajusta la ruta según tu estructura de archivos
$funcion = $_GET["function"];
if ($funcion == "create") {
    create();
} else if ($funcion == "getAll") {
    getAll();
} else if ($funcion == "deleteC") {
    deleteC();
} else if ($funcion == "edit") {
    edit();
} else if ($funcion == "getC") {
    getC();
}

function create()
{
    $response = [
        "status" => "",
        "response" => ""
    ];
    // Obtener los datos JSON enviados por la solicitud
    $data = json_decode(file_get_contents("php://input"));

    // Crear una instancia de Profesor con los datos recibidos
    $new = new Curso($data->nrc, $data->profesor_select, $data->materia_select, $data->departamento_select, $data->carrera_select, $data->periodo_select);

    $result = $new->save();

    // Enviar una respuesta basada en el resultado
    if ($result == true) {
        $response["status"] = "Success";
        $response["response"] = "Curso creado correctamente";
        echo json_encode($response);
    } else {
        $response["status"] = "Error";
        $response["response"] = "Error al crear el curso. Detalles: " . $result;
        echo json_encode($response);
    }
}

function getAll()
{
    $data = new Curso();
    $all = $data->getAll();
    echo json_encode($all);
}

function deleteC()
{
    $user_id = $_GET["user_id"];
    $profesor = new Curso();
    $result = $profesor->deleteC($user_id);

    // Enviar una respuesta basada en el resultado
    if ($result == true) {
        $response["status"] = "Success";
        $response["response"] = "Profesor eliminado correctamente";
        echo json_encode($response);
    } else {
        $response["status"] = "Error";
        $response["response"] = "Error al eliminar el profesor. Detalles: " . $result;
        echo json_encode($response);
    }
}

function getC()
{
    $response = [
        "status" => "",
        "response" => ""
    ];
    $user_id = $_GET["user_id"];
    $profesor = new Curso();
    $result = $profesor->getC($user_id);
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

function edit()
{
    $response = [
        "status" => "",
        "response" => ""
    ];
    $user_id = $_GET["user_id"];

    $data = json_decode(file_get_contents("php://input"));

    $profesor = new Curso($data->nrc,$data->profesor_id, $data->materia_id, $data->departamento_id, $data->carrera_id, $data->periodo_id);
    $result = $profesor->edit($user_id);

    // Enviar una respuesta basada en el resultado
    if ($result == true) {
        $response["status"] = "Success";
        $response["response"] = "Profesor editado correctamente";
        echo json_encode($response);
    } else {
        $response["status"] = "Error";
        $response["response"] = "Error al editar el profesor. Detalles: " . $result;
        echo json_encode($response);
    }
}
