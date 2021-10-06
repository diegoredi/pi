<?php
    class Produto{
        private $conn;
        private $table_name = "tblestoque";

        public $produto_id;
        public $produto_descricao;
        public $produto_fabricante;
        public $produto_preco;

        public function __construct($db){
            $this->conn = $db;
        }
    }

    function create(){
        $query = "INSERT INTO " .$this->table_name. "(produto_descricao, produto_fabricante, produto_preco) VALUES(:produto_descricao, :produto_fabricante, :produto_preco)";
        $stmt = $this->conn->prepare($query);

        $this->produto_descricao = htmlspecialchars(strip_tags($this->produto_descricao));
        $this->produto_fabricante = htmlspecialchars(strip_tags($this->produto_fabricante));
        $this->produto_preco = htmlspecialchars(strip_tags($this->produto_preco));

        $stmt->bindParam(":produto_descricao", $this->produto_descricao);
        $stmt->bindParam(":produto_fabricante", $this->produto_fabricante);
        $stmt->bindParam(":produto_preco", $this->produto_preco);

        if ($stmt->execute()) {
            $lastid = $stmt->LastInsertId();
            return $lastid;
        }

        return false;

    }

    function read(){
        $query = "SELECT produto_id, produto_descricao, produto_fabricante, produto_preco FROM" . $this->table_name . " ORDER BY produto_id DESC";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    function readOne(){
        $query = "SELECT produto_id, produto_descricao, produto_fabricante, produto_preco FROM" . $this->table_name . " where produto_id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->produto_id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->produto_id = $row['produto_id'];
        $this->produto_descricao = $row['produto_descricao'];
        $this->produto_fabricante = $row['produto_fabricante'];
        $this->produto_preco = $row['produto_preco'];


    }

    function readPaging(){
        $query = "SELECT produto_id, produto_descricao, produto_fabricante, produto_preco FROM" . $this->table_name . " ORDER BY produto_id DESC LIMIT ?, ?";
        $stmt = $this->conn->prepare( $query );
  
   
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);


        $stmt->execute();
  
        return $stmt;
    }

    function update(){
        $query = "UPDATE " .$this->table_name. " SET produto_descricao =:produto_descricao, produto_fabricante=:produto_fabricante, produto_preco=:produto_preco WHERE produto_id=:produto_id";
        $stmt = $this->conn->prepare($query);

        $this->produto_id = htmlspecialchars(strip_tags($this->produto_id));
        $this->produto_descricao = htmlspecialchars(strip_tags($this->produto_descricao));
        $this->produto_fabricante = htmlspecialchars(strip_tags($this->produto_fabricante));
        $this->produto_preco = htmlspecialchars(strip_tags($this->produto_preco));

        $stmt->bindParam(":produto_id", $this->produto_id);
        $stmt->bindParam(":produto_descricao", $this->produto_descricao);
        $stmt->bindParam(":produto_fabricante", $this->produto_fabricante);
        $stmt->bindParam(":produto_preco", $this->produto_preco);

        if ($stmt->execute()) {
            return true;
        }
        
        return false;

    }

    function delete(){
        $query = "DELETE FROM " .$this->table_name. " WHERE produto_id = ?";
        $stmt = $this->conn->prepare($query);

        $this->produto_id = htmlspecialchars(strip_tags($this->produto_id));
        $stmt->bindParam(1, $this->produto_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;

    }

    function search($keywords){
        $query = "SELECT produto_id, produto_descricao, produto_fabricante, produto_preco FROM" . $this->table_name . " WHERE produto_id = ? OR produto_descricao = ? ORDER BY produto_id DESC";
        $stmt= $this->conn->prepare($query);
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords="%{$keywords}%";

        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);

        $stmt->execute();

        return $stmt;

    }



?>