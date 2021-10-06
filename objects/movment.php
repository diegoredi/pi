<?php
    class Movment{
        private $conn;
        private $table_name = "tblmovment";

        public $movment_id;
        public $usuario_id;
        public $produto_id;
        public $operacao;
        public $data_hora;

        public function __construct($db){
            $this->conn = $db;
        }
    }

    function create(){
        $query = "INSERT INTO". $this->$table_name ."(usuario_id, produto_id, operacao) VALUES(:usuario_id, :produto_id, :operacao)";
        $stmt = $this->$conn->prepare($query);

        $this->usuario_id=htmlspecialchars(strip_tags($this->usuario_id));
        $this->produto_id=htmlspecialchars(strip_tags($this->produto_id));
        $this->operacao=htmlspecialchars(strip_tags($this->operacao));

        $stmt->bindParam(":usuario_id", $this->usuario_id);
        $stmt->bindParam(":produto_id", $this->produto_id);
        $stmt->bindParam(":operacao", $this->operacao);

        if($stmt->execute()){
            $lastid = $this->conn->LastInsertId();
            return $lastid;
        }
        return false;
    }
    
    function delete(){
        $query = "DELETE FROM " . $this-$table_name . " WHERE movment_id = ?";
        $stmt = $this->conn->prepare($query);
        $this->movment_id=htmlspecialchars(strip_tags($this->movment_id));
        $stmt->bindParam(1, $this->movment_id);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function read(){
        $query = "SELECT movment_id, usuario_id, produto_id, operacao, data_hora FROM " . $this->$table_name ." ORDER BY movment_id DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    function readOne(){
        $query = "SELECT movment_id, usuario_id, produto_id, operacao, data_hora FROM " . $this->$table_name . "WHERE movment_id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->movment_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->movment_id = $row['movment_id'];
        $this->usuario_id = $row['usuario_id'];
        $this->produto_id = $row['produto_id'];
        $this->operacao = $row['operacao'];
        $this->data_hora = $row['data_hora'];
    }

    function readPaging(){
        $query = "SELECT movment_id, usuario_id, produto_id, operacao, data_hora FROM " . $this->$table_name . " ORDER BY dt_cadastro DESC LIMIT ?, ?";
        $stmt = $this->conn->prepare( $query );
  
   
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);


        $stmt->execute();
  
        return $stmt;
    }

    function search($keywords){
        $query = "SELECT movment_id, usuario_id, produto_id, operacao, data_hora FROM " . $this->$table_name . " WHERE movment_id LIKE ? OR usuario_id LIKE ? ORDER BY data_hora DESC";
        $stmt= $this->conn->prepare($query);
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords="%{$keywords}%";

        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);

        $stmt->execute();

        return $stmt;

    }

    function update(){
        $query = "UPDATE " .$this->$table_name. " SET usuario_id=:usuario_id, produto_id=:produto_id, operacao=:operacao, data_hora=:data_hora where movment_id=:movment_id";

        $stmt-> $this->conn->prepare($query);

        $this->movment_id=htmlspecialchars(strip_tags($this->movment_id));
        $this->usuario_id=htmlspecialchars(strip_tags($this->usuario_id));
        $this->produto_id=htmlspecialchars(strip_tags($this->produto_id));
        $this->operacao=htmlspecialchars(strip_tags($this->operacao));
        $this->data_hora=htmlspecialchars(strip_tags($this->data_hora));

        $stmt->bindParam(':movment_id', $this->movment_id);
        $stmt->bindParam(':usuario_id', $this->usuario_id);
        $stmt->bindParam(':produto_id', $this->produto_id);
        $stmt->bindParam(':operacao', $this->operacao);
        $stmt->bindParam(':data_hora', $this->data_hora);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

?>