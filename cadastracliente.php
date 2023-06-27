<?php
include("conectadb.php");
if($_SERVER['REQUEST_METHOD']== 'POST')
{
    $cpf= $_POST['cpf'];
    $nome= $_POST['nome'];
    $senha=  $_POST['senha'];
    $datanasc=  $_POST['datanasc'];
    $telefone= $_POST['telefone'];
    $logradouro= $_POST['logradouro'];
    $numero=  $_POST['numero'];
    $cidade= $_POST['cidade'];

    $sql="SELECT COUNT(cli_cpf) FROM clientes WHERE cli_cpf= '$cpf'";
    $retorno= mysqli_query($link, $sql);

    while($tbl = mysqli_fetch_array($retorno)){
        $cont = $tbl[0];
    }

    #VALIDAÇÃO DE TRUE E FALSE
    if($cont == 1){
        echo"<script>window.alert('USUARIO JÁ EXISTE');</script>";
    }else{
        $sql= "INSERT INTO clientes (cli_cpf, cli_nome,cli_senha, cli_datanasc, cli_telefone, cli_logradouro, cli_numero, cli_cidade, cli_ativo) VALUES ('$cpf', '$nome', '$senha', STR_TO_DATE('$datanasc', '%Y-%m-%d'),'$telefone','$logradouro', '$numero', '$cidade', 's' )";
        mysqli_query($link, $sql);

        echo"<script>window.alert('CLIENTE CADASTRADO');</script>";
            echo"<script>window.location.href='admhome.php';</script>";
    }
}
#cli_id	
#cli_cpf
#cli_nome
#cli_senha
#cli_datanasc	
#cli_telefone	
#cli_logradouro	
#cli_numero	
#cli_cidade	
#cli_ativo	
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm.css">
    <title>CADASTRO DE CLIENTE</title>
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
        <form action="cadastracliente.php" method="post">
            <!--placeholder é o nome que vai aparecer dentro do text do input-->
            <input type="number" name="cpf" id="cpf" placeholder="CPF">
            <br>
            <input type="text" name="nome" id="nome" placeholder="NOME USUARIO">
            <br>
            <input type="password" name="senha" id="senha" placeholder="SENHA">
            <br>
            <input type="date" name="datanasc" id="datanasc" placeholder="DATA DE NASCIMENTO">
            <br>
            <input type="number" name="telefone" id="telefone" placeholder="TELEFONE">
            <br>
            <input type="text" name="logradouro" id="logradouro" placeholder="LOGRADOURO">
            <br>
            <input type="text" name="numero" id="numero" placeholder="NÚMERO LOGRADOURO">
            <br>
            <input type="text" name="cidade" id="cidade" placeholder="CIDADE">
            <br>
            <input type="submit" name="cadastrar" id="cadastrar" value="CADASTRA">
        </form>
    </div>

</body>

</html>