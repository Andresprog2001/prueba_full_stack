<?php
include "db/parametros.php";

// Asigna los permisos para que no haya problema con el CORS
function permisos()
{
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Credentials: true');
    }
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
        exit(0);
    }
}

permisos();
$conexion = Conectar($db);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Cunsulta todos los registros de procesos de la base de datos
    $sql = $conexion->prepare("SELECT * FROM process");
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    header("HTTP/1.1 200 OK");
    echo json_encode($sql->fetchAll());
    exit();

}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $input = $_POST;

    // Se valida con el operador ternario que cada uno de los datos contenga un valor, en caso de que no venga 
    // un valor en el $_POST se le asigna valor NULL 
    $thing = array_key_exists("thing", $input) ? "'" . $input["thing"] . "'" : "NULL";
    $activity = array_key_exists("activity", $input) ? "'" . $input["activity"] . "'" : "NULL";
    $description = array_key_exists("description", $input) ? "'" . $input["description"] . "'" : "NULL";
    $currency = array_key_exists("currency", $input) ? "'" . $input["currency"] . "'" : "NULL";
    $budget = array_key_exists("budget", $input) ? $input["budget"] : "NULL";
    $start_date = array_key_exists("start_date", $input) ? "'" . $input["start_date"] . "'" : "NULL";
    $star_time = array_key_exists("star_time", $input) ? "'" . $input["star_time"] . "'" : "NULL";
    $deadline = array_key_exists("deadline", $input) ? "'" . $input["deadline"] . "'" : "NULL";
    $closing_time = array_key_exists("closing_time", $input) ? "'" . $input["closing_time"] . "'" : "NULL";
    $created_at = date("Y-m-d H:i:s");
    $state = "ACTIVO";

    $sql = "INSERT INTO process (thing, activity, description, currency, budget, start_date, star_time, deadline, closing_time, created_at, state) VALUES 
    ($thing, $activity, $description, $currency, $budget, $start_date, $star_time, $deadline, $closing_time, '$created_at', '$state' )";

    $resultado = $conexion->prepare($sql);
    bindAllValues($resultado, $input);
    $resultado->execute();
    $id = $conexion->lastInsertId();
    if ($id) {
        $input['id'] = $id;
        header("HTTP/1.1 200 OK");
        echo json_encode($input);
        exit();
    }


}

header("HTTP/1.1 400 Peticion HTTP inexistente");
?>