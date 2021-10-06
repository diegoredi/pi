<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../objects/usuario.php';

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);

if(isset($_GET['id'])){
    $usuario->usuario_id = $_GET['id'];
}else{
    die();
}

$usuario->readOne();


if($usuario->nome!=null){
    $usuario_arr = array(
        "usuario_id" => $usuario->usuario_id,
        "usuario_nome" => $usuario->usuario_nome,
        "usuario_email"=> $usuario->usuario_email,
        "usuario_endereco"=> $usuario->usuario_endereco
    );
    http_response_code(200);
    echo json_encode($usuario_arr);
}
else{
    http_response_code(404);
    echo json_encode(array("message"=>"usuario nao existe"));
    
}