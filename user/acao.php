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
        $stmt = $pdo->prepare('INSERT INTO user (user, pass) VALUES(:user, :pass)'); 
        $user = $dados['user'];
        $stmt->bindParam(':user', $user, PDO::PARAM_STR);
        $pass = $dados['pass'];
        $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
        $stmt->execute();
        header("location:cad.php");
        
    }

    function editar($id){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE user SET user = :user, pass = :pass WHERE id = :id');
        $user = $dados['user'];
        $stmt->bindParam(':user', $user, PDO::PARAM_STR);
        $pass = $dados['pass'];
        $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $id = $dados['id'];
        $stmt->execute();
        header("location:user.php");
    }

    function excluir($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from user WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $id = $id;
        $stmt->execute();
        header("location:user.php");

    }
    
    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM user WHERE id = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id'] = $linha['id'];
            $dados['user'] = $linha['user'];
            $dados['pass'] = $linha['pass'];
        }
        return $dados;
    }
    
    function dadosForm(){
        $dados = array();
        $dados['id'] = $_POST['id'];
        $dados['user'] = $_POST['user'];
        $dados['pass'] = $_POST['pass'];
        return $dados;
    }
?>