<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../objects/estoque.php';

$database = new Database();
$db = $database->getConnection();

$estoque = new Estoque($db);

if(isset($_GET['estoque_id'])){
    $estoque->estoque_id = $_GET['estoque_id'];
}else{
    die();
}

$usuario->readOne();


if($usuario->nome!=null){
    $usuario_arr = array(
        "estoque_id" => $estoque->estoque_id,
        "produto_id" => $estoque->produto_id,
        "quantidade" => $estoque->quantidade
    );
    http_response_code(200);
    echo json_encode($estoque_arr);
}
else{
    http_response_code(404);
    echo json_encode(array("message"=>"Registro nao existe"));
    
}