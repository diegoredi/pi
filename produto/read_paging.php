<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  

include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/produto.php';

$utilities = new Utilities();

$database = new Database();
$db = $database->getConnection();
$produto = new Produto($db);

$stmt = $usuario->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();

if($num>0){
    $produto_arr=array();
    $produto_arr["records"]=array();
    $produto_arr["paging"]=array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $usuario_item=array(
            "produto_id" => $produto_id,
            "produto_descricao" => $produto_descricao,
            "produto_fabricante" => $produto_fabricante,
            "produto_preco" => $ $produto_preco
        );
        array_push($produto_arr["records"], $produto_item);
    }

    $total_rows=$produto->count();
    $page_url="{$home_url}usuario/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $produto_arr["paging"]=$paging;

    http_response_code(200);
    echo json_encode($produto_arr);
}else{
    http_response_code(404);
    echo json_decode(array("message"=>"nao foi encotrado nenhum Registro"));
}