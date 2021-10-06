<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/estoque.php';

$database = new Database();
$db = $database->getConnection();

$estoque = new Estoque($db);

$keywords=isset($_GET["s"]) ? $_GET["s"] : "";

$stmt = $estoque->search($keywords);
$num = $stmt->rowCount();

if($num>0){
    $estoque_arr=array();
    $estoque_arr["records"]=array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $estoque_item=array(
            "estoque_id"=> $estoque_id,
            "produto_id"=> $produto_id,
            "quantidade"=> $quantidade
        );
        array_push($estoque_arr['records'], $estoque_item);
    }
    http_response_code(200);
    echo json_encode($estoque_arr);
}
else{
    http_response_code(404);

    echo json_encode(array("message"=>"nenhum Registro encontrado"));
}