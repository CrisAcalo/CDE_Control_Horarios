<?php

require_once '../Model/Periodo.php';
$funcion = $_GET["function"];
if ($funcion == "create") {
    create();
} else if ($funcion == "getAll") {
    getAll();
} else if ($funcion == "deleteProfesor") {
    deleteProfesor();
} else if ($funcion == "edit") {
    edit();
} else if ($funcion == "getPeriodo") {
    getPeriodo();
}

function create()
{
    $response = [
        "status" => "",
        "response" => ""
    ];
    $dateAct = date('Y/m/d h:i:s', time());

    // Obtener los datos JSON enviados por la solicitud
    $data = json_decode(file_get_contents("php://input"));

    $inicio = $data->inicio . '-01';
    $final = $data->final . '-01';

    // Convierte las fechas al formato deseado
    $fecha_inicio_formateada = date("M y", strtotime($inicio));
    $fecha_fin_formateada = date("M y", strtotime($final));

    // Determina el periodo del año (S-I o S-II) según la fecha de inicio
    $periodo = (date("n", strtotime($inicio)) <= 6) ? "S-I" : "S-II";

    // Construye el nombre con el formato deseado
    $nombre_periodo = $periodo . " " . $fecha_inicio_formateada . " - " . $fecha_fin_formateada;

    // Crear una instancia de Profesor con los datos recibidos
    $new = new Periodo($nombre_periodo, $inicio, $final, $dateAct);

    $result = $new->save();

    // Enviar una respuesta basada en el resultado
    if ($result === true) {
        $response["status"] = "Success";
        $response["response"] = "Periodo creado exitosamente";
        echo json_encode($response);
    } else {
        $response["status"] = "Error";
        $response["response"] = "Error al crear el periodos. Detalles: " . $result;
        echo json_encode($response);
    }
}

function getAll()
{
    $datos = new Periodo();
    $all = $datos->getAll();
    echo json_encode($all);
}

function delete()
{
    $user_id = $_GET["user_id"];
    $profesor = new Periodo();
    $result = $profesor->deleteProfesor($user_id);

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

function getPeriodo()
{
    $response = [
        "status" => "",
        "response" => ""
    ];
    $user_id = $_GET["user_id"];
    $periodo = new Periodo();
    $result = $periodo->getPeriodo($user_id);
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

    $dateAct = date('Y/m/d h:i:s', time());

    // Obtener los datos JSON enviados por la solicitud
    $data = json_decode(file_get_contents("php://input"));

    $inicio = $data->inicio . '-01';
    $final = $data->final . '-01';

    // Convierte las fechas al formato deseado
    $fecha_inicio_formateada = date("M y", strtotime($inicio));
    $fecha_fin_formateada = date("M y", strtotime($final));

    // Determina el periodo del año (S-I o S-II) según la fecha de inicio
    $periodo = (date("n", strtotime($inicio)) <= 6) ? "S-I" : "S-II";

    // Construye el nombre con el formato deseado
    $nombre_periodo = $periodo . " " . $fecha_inicio_formateada . " - " . $fecha_fin_formateada;

    // Crear una instancia de Profesor con los datos recibidos
    $new = new Periodo($nombre_periodo, $inicio, $final, '' ,$dateAct);

    $result = $new->edit($user_id);

    // Enviar una respuesta basada en el resultado
    if ($result === true) {
        $response["status"] = "Success";
        $response["response"] = "Periodo editado exitosamente";
        echo json_encode($response);
    } else {
        $response["status"] = "Error";
        $response["response"] = "Error al editar el periodos. Detalles: " . $result;
        echo json_encode($response);
    }
}
