<?php 
class Produto{

    public $id;
    public $nome;
    public $quantidade;
    public $investimento;
    public $preco;
   
    
    function __construct($id, $nome, $quantidade,$investimento, $preco) {
        $this->id = $id;
        $this->nome = $nome;
        $this->quantidade = $quantidade;
        $this->preco = $preco;
        $this->investimento = $investimento;
    }
    
    function create(){
        $db = new Database();
        try{
            $stmt = $db->conn->prepare("INSERT INTO produto (nome, quantidade, preco, investimento)
            VALUES (:nome, :quantidade, :preco, :investimento)");
            $stmt->bindParam(':nome' , $this->nome);
            $stmt->bindParam(':quantidade' , $this->quantidade);
            $stmt->bindParam(':preco' , $this->preco);
            $stmt->bindParam(':investimento' , $this->investimento);
            $stmt->execute();
            $id = $db->conn->lastInsertId();

            return $id;
        }
        catch(PDOException $e){
            $result['message'] = "Erro ao criar" .$e-> getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }

    function delete(){
        $db = new Database();
        try{
            $stmt = $db->conn->prepare("DELETE FROM produto WHERE id = :id;");
            $stmt->bindParam(':id' , $this->id);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e){
            $result['message'] = "Erro ao deletar" .$e-> getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }
    
    function update(){
        $db = new Database();
        try{
            $stmt = $db->conn->prepare("UPDATE produto SET nome = :nome, quantidade=:quantidade, preco=:preco, investimento=:investimento WHERE id= :id");
            $stmt->bindParam(':id' , $this->id);
            $stmt->bindParam(':nome' , $this->nome);
            $stmt->bindParam(':quantidade' , $this->quantidade);
            $stmt->bindParam(':preco' , $this->preco);
            $stmt->bindParam(':investimento' , $this->investimento);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e){
            $result['message'] = "Erro de update." .$e-> getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }
       
    function selectAll(){
        $db = new Database();
        try{
            $stmt = $db->conn->prepare("SELECT * FROM produto ");
            $stmt->execute();
            $result = $stmt->fetchAll (PDO::FETCH_ASSOC);
            return $result;
        }
        catch(PDOException $e){
            $result['message'] = "404 - Rota api não encontrada." .$e-> getMessage();
            $response = new Output();
            $response->out($result, 404);
        }
    }
    function selectById(){
        $db = new Database();
        try{
            $stmt = $db->conn->prepare("SELECT * FROM produto WHERE id = :id;");
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            $result['message'] = "Error - SelectById: " .$e-> getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }
}

?>