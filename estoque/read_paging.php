<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  

include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/usuario.php';

$utilities = new Utilities();

$database = new Database();
$db = $database->getConnection();
$estoque = new Estoque($db);

$stmt = $estoque->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();

if($num>0){
    $estoque_arr=array();
    $estoque_arr["records"]=array();
    $estoque_arr["paging"]=array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $estoque_item=array(
            "estoque_id"=> $estoque->estoque_id,
            "produto_id"=> $estoque->produto_id,
            "quantidade"=> $estoque->quantidade
        );
        array_push($estoque_arr["records"], $estoque_item);
    }

    $total_rows=$estoque->count();
    $page_url="{$home_url}estoque/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $estoque_arr["paging"]=$paging;

    http_response_code(200);
    echo json_encode($estoque_arr);
}else{
    http_response_code(404);
    echo json_decode(array("message"=>"nao foi encotrado nenhum Registro"));
}