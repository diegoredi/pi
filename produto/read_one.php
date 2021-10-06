<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../objects/produto.php';

$database = new Database();
$db = $database->getConnection();

$produto = new Produto($db);

if(isset($_GET['produto_id'])){
    $produto->produto_id = $_GET['produto_id'];
}else{
    die();
}

$usuario->readOne();


if($produto->descricao!=null){
    $produto_arr = array(
        "produto_id" => $produto_id,
        "produto_descricao" => $produto_descricao,
        "produto_fabricante" => $produto_fabricante,
        "produto_preco" => $ $produto_preco
    );
    http_response_code(200);
    echo json_encode($produto_arr);
}
else{
    http_response_code(404);
    echo json_encode(array("message"=>"Registro nao existe"));
    
}