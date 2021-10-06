<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../objects/movment.php';

$database = new Database();
$db = $database->getConnection();

$movment = new Movment($db);

if(isset($_GET['id'])){
    $movment->movment_id = $_GET['id'];
}else{
    die();
}

$movment->readOne();


if($movment->movment_id!=null){
    $movment_arr = array(
        "movment_id" => $movment->movment_id,
        "usuario_id" => $movment->usuario_id,
        "produto_id" => $movment->produto_id,
        "operacao" => $movment->operacao,
        "data_hora" => $movment->data_hora
    );
    http_response_code(200);
    echo json_encode($movment_arr);
}
else{
    http_response_code(404);
    echo json_encode(array("message"=>"Registro não encontrado"));
    
}