<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/produto.php';

$database = new Database();
$db = $database->getConnection();

$produto = new Produto($db);

$keywords=isset($_GET["s"]) ? $_GET["s"] : "";

$stmt = $produto->search($keywords);
$num = $stmt->rowCount();

if($num>0){
    $produto_arr=array();
    $produto_arr["records"]=array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $produto_item=array(
            "produto_id" => $produto_id,
            "produto_descricao" => $produto_descricao,
            "produto_fabricante" => $produto_fabricante,
            "produto_preco" => $ $produto_preco
        );
        array_push($produto_arr['records'], $produto_item);
    }
    http_response_code(200);
    echo json_encode($produto_arr);
}
else{
    http_response_code(404);

    echo json_encode(array("message"=>"nenhum produto encontrado"));
}