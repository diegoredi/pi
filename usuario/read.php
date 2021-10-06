<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../objects/usuario.php';
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);

$stmt = $usuario->read();
$num = $stmt->rowCount();

if($num>0){
    $usuario_arr=array();
    $usuario_arr['records']=array();
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $usuario_item=array(
            "usuario_id" => $usuario->usuario_id,
            "usuario_nome" => $usuario->usuario_nome,
            "usuario_email"=> $usuario->usuario_email,
            "usuario_endereco"=> $usuario->usuario_endereco
        );
        array_push($usuario_arr["records"], $usuario_item);
    }
    http_response_code(200);
    echo json_encode($usuario_arr);
}
else{
    http_response_code(404);
    echo json_encode(array("message"=>"Nao foi encontrado nenhum usuario"));
}