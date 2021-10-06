<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  

include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/movment.php';

$utilities = new Utilities();

$database = new Database();
$db = $database->getConnection();
$movment = new Movment($db);

$stmt = $movment->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();

if($num>0){
    $movment_arr=array();
    $movment_arr["records"]=array();
    $movment_arr["paging"]=array();

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

    $total_rows=$movment->count();
    $page_url="{$home_url}movment/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $movment_arr["paging"]=$paging;

    http_response_code(200);
    echo json_encode($movment_arr);
}else{
    http_response_code(404);
    echo json_decode(array("message"=>"nao foi encotrado nenhum registro"));
}