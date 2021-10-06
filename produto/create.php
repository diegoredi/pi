<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/produto.php';

$database = new Database();
$db = $database->getConnection();
$produto = new Produto($db);

$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->descricao) &&
    !empty($data->fabricante) &&
    !empty($data->preco)
){
    $produto->produto_nome = $data->descricao;
    $produto->produto_fabricante = $data->fabricante;
    $produto->produto_preco = $data->preco;

    $create = $produto->create();

    if($create){
        http_response_code(201);
        echo json_encode(array("message"=>$create));
    }
    else{
        http_response_code(503);
        echo json_encode(array("message"=>"Nao foi possivel criar o registro"));
    }
}
else{
    http_response_code(400);
    echo json_encode(array("message"=>"preencha todos os dados"));
}