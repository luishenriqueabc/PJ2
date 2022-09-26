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
      
        
        $produto = new Produto(null, $nome, $quantidade, $investimento, $preco);
        $id = $produto->create();

        // saida
        $result['message'] = "Produto feito com sucesso";
        $result['produto']['id'] = $id;
        $result['produto']['nome'] = $nome;
        $result['produto']['quantidade'] = $quantidade;
        $result['produto']['investimento'] = $investimento;
        $result['produto']['preco'] = $preco;
        $response->out($result);
    }
  
    function delete(){
        $response = new Output();
        $response->allowedMethod('POST'); 

        $id = $_POST['id'];
        $produto= new Produto ($id,null,null,null,null);
        $produto->delete();
        $result['message'] = "Produto deletado com sucesso";
        $result['produto']['id'] = $id;
        $response->out($result);
    }

    function update(){
        $response = new Output();
        $response->allowedMethod('POST');


        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $quantidade = $_POST['quantidade'];
        $investimento = $_POST['investimento'];
        $preco = $_POST['preco'];

        $produto = new Produto($id,$nome,$quantidade,$investimento, $preco);
        $produto->update();
        $result['message'] = "Produto editado com Sucesso";
        $result['produto']['id'] = $id;
        $result['produto']['nome'] = $nome;
        $result['produto']['quantidade'] = $quantidade;
        $result['produto']['investimento'] = $investimento;
        $result['produto']['preco'] = $preco;

        $response->out($result);
    }

    function selectAll(){
        $response = new Output();
        $response->allowedMethod('GET');

        $produto= new Produto(null,null,null,null,null);
        $result = $produto->selectAll();
        $response->out($result);

    }

    function selectById(){
        $response = new Output();
        $response->allowedMethod('GET');
        $id = $_GET['id'];
        $produto = new Produto ($id,null,null,null,null);
        $result = $produto->selectById();
        
        $response->out($result);

    }
}
?>