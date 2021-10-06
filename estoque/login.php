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



if(!empty($data->nome) && !empty($data->senha)){
    $usuario->nome = $data->nome;
    $usuario->senha = $data->senha;
    $login = $usuario->login();

    if($login == true){
        http_response_code(200);
        echo json_encode(array("message"=>"logado"));
        session_start();
        $_SESSION['valid'] = true;
        $_SESSION['id'] = $data->nome;
    }else{
        http_response_code(400);
        echo json_encode(array("message"=>"nao foi encontrado o login"));
    }
}else{
    echo json_encode(array("message"=>"Preencha todos os dados por favor"));
}

