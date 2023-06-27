<?php
include("conectadb.php");
    session_start();
    $nomeusuario = $_SESSION['nomeusuario'];

#JÁ LISTA OS USUÁRIOS DO MEU BANCO

$sql = "SELECT * FROM clientes WHERE cli_ativo = 's'";
$retorno = mysqli_query($link, $sql);

#JÁ FORÇA TRAZER NA VARIÁVEL ATIVO
$ativo = 's';

# COLETA O BOTÃO DE POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ativo = $_POST['ativo'];

    #VERIFICA SE USUÁRIO ESTÁ ATIVO PARA A LISTA
    if ($ativo == 's') {
        $sql = "SELECT * FROM clientes WHERE cli_ativo = 's'";
        $retorno = mysqli_query($link, $sql);
    } else {
        $sql = "SELECT * FROM clientes WHERE cli_ativo = 'n'";
        $retorno = mysqli_query($link, $sql);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm.css">
    <title>Lista USUÁRIOS</title>

</head>

<body>
    <div>
        <ul class="menu">
        <li><a href="cadastrausuario.php">CADASTRA USUÁRIO</a></li>
            <li><a href="listausuario.php">LISTA USUÁRIO</a></li>
            <li><a href="cadastracliente.php">CADASTRA CLIENTE</a></li>
            <li><a href="listacliente.php">LISTA CLIENTE</a></li>
            <li class="menuloja"><a href="logout.php">SAIR</a></li>
            <?php
            #ABERTO O PHP PARA VALIDAR SE A SESSÃO DO USUARIO ESTÁ ABERTA
            # SE SESSÃO ABERTA, FECHA O PHP PARA USAR ELEMENTOS HTML
            if ($nomeusuario != null) {
                ?>
                <!--USO DE ELEMENTO HTML COM PHP INTERNO-->
                <li class="profile">Olá
                    <?= strtoupper($nomeusuario) ?>
                </li>
                <?php
                # ABERTURA DE OUTRO PHP PARA CASO FALSE
            } else {
                echo "<script>window.alert('USUARIO NÃO AUTENTICADO'); window.location.href='login.php';</script>";
            }
            # FIM DO PHP PARA CONTINUAR MEU HTML
            ?>
        </ul>
    </div>
    
    <!--AQUI LISTA OS USUÁRIOS DO BANCO-->
    <div id="background">
        <form action="listacliente.php" method="post">
            <input type="radio" name="ativo" class="radio" value="s" required onclick="submit()" 
            <?=$ativo == 's'? "checked":""?>>ATIVOS

            <input type="radio" name="ativo" class="radio" value="n" required onclick="submit()" 
            <?=$ativo == 'n'? "checked":""?>>INATIVOS

        </form>

        <div class="container">
            <table border="1">
                <tr>
                    <th>NOME</th>
                    <th>ALTERAR DADOS</th>
                    <th>ATIVO?</th>
                </tr>

                <!--BRUXARIA EM PHP-->
                <?php
                    while($tbl = mysqli_fetch_array($retorno)){
                ?>
                    <tr>
                        <td><?= $tbl[2]?></td> <!--TRAZ SOMENTE A COLUNA 1 DO BANCO [NOME]-->
                        <td><a href="alteracliente.php?id=<?=$tbl[0]?>"><input type="button" value="ALTERAR DADOS"></a></td> 
                        <td><?=$check = ($tbl[9] == 's')?"SIM":"NÃO"?></td><!--VALIDA S OU N E ESCREVE "SIM" E "NÃO"-->
                    </tr>
                    <?php 
                    }
                    ?>
                
            
            </table>
        </div>
    </div>

</body>

</html>