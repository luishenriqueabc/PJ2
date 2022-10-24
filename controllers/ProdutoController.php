<?php
class ProdutoController{
    
    function create(){
        $response = new Output();
        $response->allowedMethod('POST'); 
        // entrada  
        $nome = $_POST['nome'];
        $quantidade = $_POST['quantidade'];
        $investimento = $_POST['investimento'];
        $preco = $_POST['preco'];
        $lucro = $_POST['lucro'];
        $valortotal = $_POST['valortotal'];
      
        
        $produto = new Produto(null, $nome, $quantidade, $investimento,$preco,$lucro,$valortotal);
        $id = $produto->create();

        // saida
        $result['message'] = "LUCRO CONTABILIZADO";
        $result['produto']['id'] = $id;
        $result['produto']['nome'] = $nome;
        $result['produto']['quantidade'] = $quantidade;
        $result['produto']['investimento'] = $investimento;
        $result['produto']['preco'] = $preco;
        $result['produto']['lucro'] = $lucro;
        $result['produto']['valortotal'] = $valortotal;
        $response->out($result);
    }
  
    function delete(){
        $response = new Output();
        $response->allowedMethod('POST'); 

        $id = $_POST['id'];
        $produto= new Produto ($id,null,null,null,null,null,null);
        $produto->delete();
        $result['message'] = "Produto deletado com sucesso";
        $result['produto']['id'] = $id;
        $response->out($result);
    }
    function selectAll(){
        $response = new Output();
        $response->allowedMethod('GET');

        $produto= new Produto(null,null,null,null,null,null,null);
        $result = $produto->selectAll();
        $response->out($result);
    }
    function selectById(){
        $response = new Output();
        $response->allowedMethod('GET');
        $id = $_GET['id'];
        $produto = new Produto ($id,null,null,null,null,null);
        $result = $produto->selectById();

        $response->out($result);

    }
    function selectlucro(){
        $response = new Output();
        $response->allowedMethod('GET');

        $produto= new Produto(null,null,null,null,null,null,null);
        $result = $produto->selectlucro();

        $response->out($result);

    }
}
?>