<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/usuario.php';

$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);

$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->nome) &&
    !empty($data->senha) &&
    !empty($data->email) &&
    !empty($data->endereco)
){
    $usuario->usuario_nome = $data->nome;
    $usuario->usuario_senha = $data->senha;
    $usuario->usuario->email = $data->email;
    $usuario->usuario->endereco = $data->endereco;

    $create = $usuario->create();

    if($create){
        http_response_code(201);
        echo json_encode(array("message"=>$create));
    }
    else{
        http_response_code(503);
        echo json_encode(array("message"=>"Nao foi possivel criar o usuario"));
    }
}
else{
    http_response_code(400);
    echo json_encode(array("message"=>"preencha todos os dados"));
}