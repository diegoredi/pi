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

$usuario->usuario_id = $data->id;
$usuario->usuario_nome = $data->nome;
$usuario->usuario_senha = $data->sennha;
$usuario->email = $data->email;
$usuario->endereco = $data->endereco;

if($usuario->update()){
    http_response_code(200);
    echo json_encode(array("message"=>"Usuario foi atualizado"));
}
else{
    http_response_code(503);
    echo json_encode(array("message"=>"Nao foi possivel atualizar usuario"));
}