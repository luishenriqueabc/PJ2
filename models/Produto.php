<?php 
class Produto{

    public $id;
    public $nome;
    public $quantidade;
    public $preco;
    public $investimento;
    public $lucro;
    public $valortotal;
   
    
    function __construct($id, $nome, $quantidade,$investimento, $preco,$lucro,$valortotal) {
        $this->id = $id;
        $this->nome = $nome;
        $this->quantidade = $quantidade;
        $this->preco = $preco;
        $this->investimento = $investimento;
        $this->lucro = $lucro;
        $this->valortotal = $valortotal;
    }
    
    function create(){
        $db = new Database();
        try{
            $stmt = $db->conn->prepare("INSERT INTO produto (nome, quantidade, preco, investimento,valortotal,lucro)
            VALUES (:nome, :quantidade, :preco, :investimento,:valortotal,:lucro)");
            $stmt->bindParam(':nome' , $this->nome);
            $stmt->bindParam(':quantidade' , $this->quantidade);
            $stmt->bindParam(':preco' , $this->preco);
            $stmt->bindParam(':investimento' , $this->investimento);
            $stmt->bindParam(':lucro' , $this->lucro);
            $stmt->bindParam(':valortotal' , $this->valortotal);
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

    // function selectlucro(){
    //     $db = new Database();
    //     try{
    //         $stmt = $db->conn->prepare("SELECT lucro FROM produto ");
    //         $stmt->execute();
    //         $result = $stmt->fetchAll (PDO::FETCH_ASSOC);
    //         return $result;
    //     }
    //     catch(PDOException $e){
    //         $result['message'] = "404 - Rota api não encontrada." .$e-> getMessage();
    //         $response = new Output();
    //         $response->out($result, 404);
    //     }
    // }
}

?>