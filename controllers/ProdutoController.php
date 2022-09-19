<?php
class ProdutoController{
    
    function create(){
        $response = new Output();
        $response->allowedMethod('POST'); 
        // entrada  
        $nome = $_POST['nome'];
        $quantidade = $_POST['quantidade'];
        $preco = $_POST['preco'];
        $investimento = $_POST['investimento'];
      
        
        $produto = new Produto(null, $nome, $quantidade, $preco, $investimento);
        $id = $produto->create();

        // saida
        $result['message'] = "Produto feito com sucesso";
        $result['produto']['id'] = $id;
        $result['produto']['nome'] = $nome;
        $result['produto']['quantidade'] = $quantidade;
        $result['produto']['preco'] = $preco;
        $result['produto']['investimento'] = $investimento;
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
        $preco = $_POST['preco'];
        $investimento = $_POST['investimento'];

        $produto = new Produto($id,$nome,$quantidade,$preco,$investimento);
        $produto->update();
        $result['message'] = "Produto editado com Sucesso";
        $result['produto']['id'] = $id;
        $result['produto']['nome'] = $nome;
        $result['produto']['quantidade'] = $quantidade;
        $result['produto']['preco'] = $preco;
        $result['produto']['investimento'] = $investimento;

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