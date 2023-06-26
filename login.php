<?php
    ## ABRE UMA VARIÁVEL SESSÃO
    session_start();
    $nomeusuario;

    # SOLICITA O ARQUIVO CONECTABD
    include("conectadb.php");

    # EVENTO APÓS O CLICK NO BOTÃO LOGAR
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];
        
        #QUERY DE BANCO DE DADOS
        $sql = "SELECT COUNT(usu_id) FROM usuarios WHERE usu_nome = '$nome' AND usu_senha = '$senha' AND usu_ativo= 's'";
        $retorno = mysqli_query($link, $sql);

        # TODO RETORNO DO BANCO É RETORNADO EM ARRAY EM PHP
        while($tbl = mysqli_fetch_array($retorno))
        {
            $cont = $tbl[0];

        }
        # VERIFICA SE USUARIO EXISTE
        # SE $CONT == 1 ELE EXISTE E FAZ LOGIN
        # SE $CONT == 0 ELE NÃO EXISTE E USUARIO NÃO ESTÁ CADASTRADO

        if($cont == 1)
        {
            $sql = "SELECT * FROM usuarios WHERE usu_nome = '$nome' AND usu_senha = '$senha' AND usu_ativo = 's'";

            $_SESSION['nomeusuario'] = $nome;
            
            # DIRECIONA USUARIO PARA ADM
            echo"<script>window.location.href='admhome.php';</script>";
        }else{
            echo"<script>window.alert('USUARIO OU SENHA INCORRETO');</script>";
        }
    }


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN USUARIO</title>
    <link rel="stylesheet" href="./css/estiloadm.css">
</head>
<body>
    <form action="login.php" method="post"> 
        <h1>LOGIN DE USUARIO</h1>
        <input type="text" name="nome" placeholder="NOME" required>
        <p></p>
        <input type="password" name="senha" placeholder="SENHA" required>
        <p></p>
        <input type="submit" name="login" value="LOGIN">


    </form>
    
</body>
</html>