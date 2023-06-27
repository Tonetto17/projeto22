<?php
include("conectadb.php");
    if($_SERVER['REQUEST_METHOD']== 'POST')
    {
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];

        #VALIDAÇÃO DE USUARIO. VERIFICA SE USUARIO JÁ EXISTE
        $sql= "SELECT COUNT(usu_id) FROM usuarios WHERE usu_nome = '$nome' AND usu_senha = '$senha'";
        $retorno = mysqli_query($link, $sql);


        while($tbl = mysqli_fetch_array($retorno)){
            $cont = $tbl[0];
        }

        #VALIDAÇÃO DE TRUE E FALSE
        if($cont == 1){
            echo"<script>window.alert('USUARIO JÁ EXISTE');</script>";
        }
        else{
            $sql= "INSERT INTO usuarios (usu_nome, usu_senha, usu_ativo) VALUES ('$nome', '$senha', 'n')";
            mysqli_query($link, $sql);
            
            #CADASTRA USUARIO E JOGA MENSAGEM NA TELA E DIRECIONA PARA A LISTA USUARIO
            echo"<script>window.alert('USUARIO CADASTRADO');</script>";
            echo"<script>window.location.href='listausuario.php';</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm.css">
    <title>CADASTRO DE USUARIO</title>
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
        <form action="cadastrausuario.php" method="post">
             <!--placeholder é o nome que vai aparecer dentro do text do input-->
            <input type="text" name="nome" id="nome" placeholder="NOME USUARIO"> 
            <br>
            <input type="password" name="senha" id="senha" placeholder="SENHA">
            <br>
            <input type="submit" name="cadastrar" id="cadastrar" value="CADASTRA">
        </form>
    </div>
    
</body>
</html>