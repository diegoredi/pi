<?php
class Usuario{
    private $conn;
    private $table_name = "tblusuario";

    public $usuario_id;
    public $usuario_nome;
    public $usuario_senha;
    public $usuario_email;
    public $usuario_endereco;


    public function __construct($db){
        $this->conn = $db;
    }


    function login(){
        if ($this->usuario_nome != null && $this->usuario_senha != null){

            $query = "SELECT count(*) FROM " .$this->table_name. " WHERE nome =" .$this->usuario_nome. " and senha =" .$this->usuario_senha;

            $stmt = $this->conn->prepare($query);
            
            if($stmt->execute() >= 1){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    function read(){
        $query = "SELECT usuario_id, usuario_nome, usuario_email, usuario_endereco FROM ". $this->table_name." ORDER BY usuario_id DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    function create(){
        $query = "INSERT INTO ". $this->table_name. " (usuario_nome, usuario_senha, usuario_email, usuario_endereco) VALUES (:usuario_nome, :usuario_senha, :usuario_email, :usuario_endereco)";
        
        $stmt = $this->conn->prepare($query);

        $this->usuario_nome=htmlspecialchars(strip_tags($this->usuario_nome));
        $this->usuario_senha=htmlspecialchars(strip_tags($this->usuario_senha));
        $this->usuario_email=htmlspecialchars(strip_tags($this->usuario_email));
        $this->usuario_endereco=htmlspecialchars(strip_tags($this->usuario_endereco));

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":senha", $this->senha);

        

        if($stmt->execute()){
            $lastId = $this->conn->LastInsertId();
            return $lastId;
        }
        return false;
    }

    function readOne(){
        $query = "SELECT usuario_id, usuario_nome,  usuario_email, usuario_endereco FROM " .$this->table_name. "  WHERE usuario_id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->usuario_id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->usuario_id = $row['usuario_id'];
        $this->usuario_nome = $row['usuario_nome'];
        $this->usuario_email = $row['usuario_email'];
        $this->usuario_endereco = $row['usuario_endereco'];
    }

    function update(){
        $query = "UPDATE " .$this->table_name. " SET usuario_nome=:usuario_nome, usuario_senha=:usuario_senha, usuario_email:=usuario_email, usuario_endereco:=usuario_endereco WHERE usuario_id=:usuario_id";
        $stmt = $this->conn->prepare($query);

        $this->usuario_nome=htmlspecialchars(strip_tags($this->usuario_nome));
        $this->usuario_senha=htmlspecialchars(strip_tags($this->usuario_senha));
        $this->usuario_email=htmlspecialchars(strip_tags($this->usuario_email));
        $this->usuario_endereco=htmlspecialchars(strip_tags($this->usuario_endereco));

        $stmt->bindParam(':usuario_nome', $this->usuario_nome);
        $stmt->bindParam(':usuario_senha', $this->usuario_senha);
        $stmt->bindParam(':usuario_email', $this->usuario_email);
        $stmt->bindParam(':usuario_endereco', $this->usuario_endereco);

        if($stmt->execute()){
            return true;
        }

        return false;

    }

    function delete(){
        $query = "DELETE FROM " .$this->table_name. " WHERE usuario_id = ?";

        $stmt = $this->conn->prepare($query);
        $this->usuario_id=htmlspecialchars(strip_tags($this->usuario_id));
        $stmt->bindParam(1, $this->usuario_id);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function search($keywords){
        $query = "SELECT usuario_id, usuario_nome, usuario_email, usuario_endereco FROM " .$this->table_name. " WHERE usuario_id LIKE ? OR usuario_nome LIKE ? ORDER BY usuario_id DESC";

        $stmt = $this->conn->prepare($query);

        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);

        $stmt->execute();

        return $stmt;
    }

    function readPaging($from_record_num, $records_per_page){
        $query = "SELECT usuario_id, usuario_nome, usuario_email, usuario_endereco FROM " .$this->table_name. " ORDER BY usuario_id DESC LIMIT ?, ?";
        $stmt = $this->conn->prepare( $query );
  
   
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);


        $stmt->execute();
  
        return $stmt;
    }

    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
        return $row['total_rows'];
    }

}