<!DOCTYPE html>
<?php 
include_once "../conf/default.inc.php";
require_once "../conf/Conexao.php";
$title = "Lista de usuários ";
$consulta = isset($_POST['consulta']) ? $_POST['consulta'] : "";
$tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : 1;

?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title   >
    <link rel="stylesheet" href="css/estilo.css">
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url; 
        }
    </script>
</head>
<body>
    <?php include '../menu.php'; ?>
    <br>
    <a href="cad.php"><button>Novo</button></a>
    <br><br>
    <form method="post">
    <input type="text" name="consulta" id="consulta" value="<?php echo $consulta; ?>">
    <input type="submit" value="Pesquisar">
    <br><br>
        <legend>Pesquisar por: </legend>


        <input type="radio" name="tipo" value="1" <?php if ($tipo == 1){echo 'checked';}?>> 
        <label for="nome">Usuário</label>

        <input type="radio" name="tipo" value="2" <?php if ($tipo == 2){echo 'checked';}?>>
        <label for="email">Senha</label>
    </form>
    
    <br>
    <table border="1">
       <tr><th>ID</th>
        <th>Usuario</th> 
        <th>Senha</th> 
        <th>Alterar</th>
        <th>Excluir</th>
    </tr>
    <?php 
    $pdo = Conexao::getInstance();
    if ($tipo == 1 ) 

    $consulta = $pdo->query("SELECT * FROM user 
                             WHERE user 
                             LIKE '$consulta%'
                             ORDER BY user");

    else
    $consulta = $pdo->query("SELECT * FROM user
                            WHERE pass
                            LIKE '$consulta%'
                            ORDER BY pass");

    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
        ?>
        <tr><td><?php echo $linha['id'];?></td>
            <td><?php echo $linha['user'];?></td>
            <td><?php echo $linha['pass'];?></td>
            <td><a href='cad.php?acao=editar&id=<?php echo $linha['id'];?>'><img class="icon" src="../img/edit.png" alt=""></a></td>
            <td><a href="javascript:excluirRegistro('acao.php?acao=excluir&id=<?php echo $linha['id'];?>')"><img class="icon" src="../img/delete.png" alt=""></a></td>
        </tr>
    <?php } ?>       
    </table>
    
</body>
</html>