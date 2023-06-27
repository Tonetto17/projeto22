<?php
include("conectadb.php");

session_start();
$nomeusuario = $_SESSION['nomeusuario'];

#TRAZ DADOS DO BANCO PARA COMPLETAR OS CAMPOS
$id = $_GET['id'];
$sql = "SELECT * FROM clientes WHERE cli_id= '$id'";
$retorno = mysqli_query($link, $sql);

#PREENCHA O ARRAY SEMPRE
while ($tbl = mysqli_fetch_array($retorno)) {
    $cpf = $tbl[1];
    $nome = $tbl[2]; # CAMPO NOME DA TABELA DO BANCO
    $senha = $tbl[3]; #CAMPO SENHA DA TABELA DO BANCO
    $datanasc = $tbl[4]; #CAMPO ATIVO DA TABELA DO BANCO
    $telefone = $tbl[5];
    $logradouro = $tbl[6];
    $numero = $tbl[7];
    $cidade = $tbl[8];
    $ativo = $tbl[9];

}

# USUÁRIO CLICA NO BOTÃO SALVAR
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $datanasc = $_POST['datanasc'];
    $telefone = $_POST['telefone'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $cidade = $_POST['cidade'];
    $ativo = $_POST['ativo'];

    $sql = "UPDATE clientes SET cli_cpf='$cpf', cli_nome = '$nome', cli_senha= '$senha', cli_datanasc='$datanasc', cli_telefone='$telefone', cli_logradouro='$logradouro', cli_numero= '$numero', cli_cidade='$cidade', cli_ativo= '$ativo' WHERE cli_id= $id";

    mysqli_query($link, $sql);

    echo "<script>window.alert('CLIENTE ALTERADO COM SUCESSO!');</script>";
    echo "<script>window.location.href='admhome.php';</script>";
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm.css">
    <title>ALTERA USUÁRIO</title>
</head>

<body>
    <div>
        <ul class="menu">
            <li><a href="cadastrausuario.php">CADASTRA USUÁRIO</a></li>
            <li><a href="listausuario.php">LISTA USUÁRIO</a></li>
            <li><a href="cadastracliente.php">CADASTRA CLIENTE</a></li>
            <li><a href="listacliente.php">LISTA CLIENTE</a></li>
            <li class="menuloja"><a href="logout.php">SAIR</a></li>
        </ul>
    </div>

    <div>
        <form action="alteracliente.php" method="post">

            <input type="hidden" name="id" value="<?= $id ?>">

            <br>

            <input type="number" name="cpf" id="cpf" value="<?= $cpf ?>" required>

            <br>

            <input type="text" name="nome" id="nome" value="<?= $nome ?>" required>

            <br>

            <input type="password" name="senha" id="senha" value="<?= $senha ?>" required>

            <br>

            <input type="date" name="datanasc" id="datanasc" value="<?= $datanasc ?>" required>

            <br>

            <input type="number" name="telefone" id="telefone" value="<?= $telefone ?>" required>

            <br>

            <input type="text" name="logradouro" id="logradouro" value="<?= $logradouro ?>" required>

            <br>

            <input type="text" name="numero" id="numero" value="<?= $numero ?>" required>

            <br>

            <input type="text" name="cidade" id="cidade" value="<?= $cidade ?>" required>

            <br>

            <input type="radio" name="ativo" value="s" <?= $ativo == "s" ? "checked" : "" ?>>ATIVO

            <input type="radio" name="ativo" value="n" <?= $ativo == "n" ? "checked" : "" ?>>INATIVO
            <p></P>
            <input type="submit" name="salvar" id="salvar" value="SALVAR">

        </form>
    </div>

</body>

</html>