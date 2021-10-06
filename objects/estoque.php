<?php
    class Estoque{
        private $conn;
        private $table_name = "tblestoque";

        public $estoque_id;
        public $produto_id;
        public $quantidade;

        public function __construct($db){
            $this->conn = $db;
        }
    }

    function create(){
        $query = "INSERT INTO " . $this->table_name. "(produto_id, quantidade) VALUES(:produto_id, quantidade)";
        $stmt = $this->conn->prepare($query);

        $this->produto_id = htmlspecialchars(strip_tags($this->produto_id));
        $this->quantidade = htmlspecialchars(strip_tags($this->quantidade));

        $stmt->bindParam(':produto_id', $this->produto_id);
        $stmt->bindParam(':quantidade', $this->quantidade);

        if ($stmt->execute()) {
            $lastid = $stmt->LastInsertId();
            return $lastid;
        }

        return false;
    }

    function read(){
        $query = "SELECT estoque_id, produto_id, quantidade FROM" .$this->table_name. "ORDER BY estoque_id";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;

    }

    function readOne(){
        $query = "SELECT estoque_id, produto_id, quantidade FROM" .$this->table_name. " WHERE estoque_id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);

        $this->estoque_id = htmlspecialchars(strip_tags($this->estoque_id));

        $stmt->bindParam(1, $this->estoque_id);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->estoque_id = $row['estoque_id'];
        $this->produto_id = $row['produto_id'];
        $this->quantidade = $row['quantidade'];

    }

    function readPaging(){
        $query = "SELECT estoque_id, produto_id, quantidade FROM" .$this->table_name. "ORDER BY estoque_id DESC LIMIT ?,?";
        $stmt = $this->conn->prepare( $query );
  
   
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);


        $stmt->execute();
  
        return $stmt;
    }

    function update(){
        $query = "UPDATE " .$this->table_name. " SET produto_id=:produto_id, quantidade=:quantidade WHERE estoque_id =:estoque_id";
        $stmt = $this->conn->prepare($query);

        $this->estoque_id = htmlspecialchars(strip_tags($this->estoque_id));
        $this->produto_id = htmlspecialchars(strip_tags($this->produto_id));
        $this->quantidade = htmlspecialchars(strip_tags($this->quantidade));

        $stmt->bindParam(":estoque_id", $this->estoque_id);
        $stmt->bindParam(":produto_id", $this->produto_id);
        $stmt->bindParam(":quantidade", $this->quantidade);
        
        if ($stmt->execute()) {
            return true;
        }

        return false;

    }

    function delete(){
        $query = "DELETE FROM" .$this->table_name. " WHERE estoque_id = ?";
        $stmt = $this->conn->prepare($query);

        $this->estoque_id = htmlspecialchars(strip_tags($this->estoque_id));
        $stmt->bindParam(1, $this->estoque_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function search($keywords){
        $query = "SELECT estoque_id, produto_id, quantidade FROM" .$this->table_name. " WHERE estoque_id = ? OR produto_id = ?";
        $stmt = $this->conn->prepare($query);
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords="%{$keywords}%";

        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);

        $stmt->execute();

        return $stmt;
    }



?>