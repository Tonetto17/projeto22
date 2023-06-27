<?php
    include("conectadb.php");

    session_start();
    $nomeusuario = $_SESSION['nomeusuario'];

    #TRAZ DADOS DO BANCO PARA COMPLETAR OS CAMPOS
    $id= $_GET['id'];
    $sql= "SELECT * FROM usuarios WHERE usu_id= '$id'";
    $retorno= mysqli_query($link, $sql);

    #PREENCHA O ARRAY SEMPRE
    while($tbl= mysqli_fetch_array($retorno)){
        $nome= $tbl[1]; # CAMPO NOME DA TABELA DO BANCO
        $senha= $tbl[2]; #CAMPO SENHA DA TABELA DO BANCO
        $ativo= $tbl[3]; #CAMPO ATIVO DA TABELA DO BANCO
    }

    # USUÁRIO CLICA NO BOTÃO SALVAR
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $id= $_POST['id'];
        $nome= $_POST['nome'];
        $senha= $_POST['senha'];
        $ativo= $_POST['ativo'];

        $sql= "UPDATE usuarios SET usu_nome = '$nome', usu_senha= '$senha', usu_ativo= '$ativo' WHERE usu_id= $id";

        mysqli_query($link, $sql);

        echo"<script>window.alert('USUARIO ALTERADO COM SUCESSO!');</script>";
        echo"<script>window.location.href='admhome.php';</script>";
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
        <ul class="menu" >
        <li><a href="cadastrausuario.php">CADASTRA USUÁRIO</a></li>
            <li><a href="listausuario.php">LISTA USUÁRIO</a></li>
            <li><a href="cadastracliente.php">CADASTRA CLIENTE</a></li>
            <li><a href="listacliente.php">LISTA CLIENTE</a></li>
            <li class="menuloja"><a href="logout.php">SAIR</a></li>
        </ul>
    </div>

    <div>
        <form action="alterausuario.php" method="post">
             <!--placeholder é o nome que vai aparecer dentro do text do input-->
             <input type="hidden" name="id" value="<?=$id?>">
            <input type="text" name="nome" id="nome" value="<?= $nome?>" required> 
            <br>
            <input type="password" name="senha" id="senha" value="<?= $senha?>" required>
            <br>
            <input type="radio" name="ativo" value="s" <?=$ativo== "s"?"checked":""?>>ATIVO
            <br>
            <input type="radio" name="ativo" value="n" <?=$ativo== "n"?"checked":""?>>INATIVO
            <p></p>
            <input type="submit" name="salvar" id="salvar" value="SALVAR">
        </form>
    </div>
    
</body>
</html>