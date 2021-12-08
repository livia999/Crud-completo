<?php

    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";

    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        excluir($id);
    }

    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        if ($id == 0)
            inserir($id);
        else
            editar($id);
    }

    function inserir($id){
        $dados = dadosForm();
        
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO rotulo (descricao) VALUE(:descricao)'); 
        $descricao = $dados['descricao'];
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->execute();
        header("location:cad.php");
        
    }

    function editar($id){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE rotulo SET descricao = :descricao WHERE id = :id');
        $descricao = $dados['descricao'];
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $id = $dados['id'];
        $stmt->execute();
        header("location:rotulo.php");
    }

    function excluir($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from rotulo WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $id = $id;
        $stmt->execute();
        header("location:rotulo.php");

    }
    
    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM rotulo WHERE id = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id'] = $linha['id'];
            $dados['descricao'] = $linha['descricao'];
        }
        return $dados;
    }
    
    function dadosForm(){
        $dados = array();
        $dados['id'] = $_POST['id'];
        $dados['descricao'] = $_POST['descricao'];
        return $dados;
    }
?>