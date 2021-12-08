<!DOCTYPE html>
<?php
include_once "acao.php";
$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
$dados;
if ($acao == 'editar'){
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if ($id > 0)
        $dados = buscarDados($id);
}
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro</title>
</head>
<body>
<br>
<a href="user.php"><button>Listar</button></a>
<br><br>
<form action="acao.php" method="post">
<fieldset>
<label for="id">ID:</label>
<input readonly  type="text" name="id" id="id" value="<?php if ($acao == "editar") echo $dados['id']; else echo 0; ?>"><br>

<label for="user">Usuário:</label>
<input required=true   type="text" name="user" id="user" value="<?php if ($acao == "editar") echo $dados['user']; ?>"><br>

<label for="pass">Senha:</label>
<input required=true   type="text" name="pass" id="pass" value="<?php if ($acao == "editar") echo $dados['pass']; ?>"><br>
    <br><button type="submit" name="acao" id="acao" value="salvar">Salvar</button>
</fieldset>
</form>
</body>
</html>