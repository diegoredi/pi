<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../objects/movment.php';
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$movment = new Movment($db);

$stmt = $movment->read();
$num = $stmt->rowCount();

if($num>0){
    $movment_arr=array();
    $movment_arr['records']=array();
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $movment_item=array(
            "movment_id" => $movment->movment_id,
            "usuario_id" => $movment->usuario_id,
            "produto_id" => $movment->produto_id,
            "operacao" => $movment->operacao,
            "data_hora" => $movment->data_hora
        );
        array_push($movment_arr["records"], $movment_item);
    }
    http_response_code(200);
    echo json_encode($movment_arr);
}
else{
    http_response_code(404);
    echo json_encode(array("message"=>"Nao foi encontrado nenhum registro"));
}
