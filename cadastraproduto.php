<?php
include("conectadb.php");

session_start();
$nomeusuario = $_SESSION['nomeusuario'];

if($_SERVER['REQUEST_METHOD']=='POST'){
    $nome= $_POST['nome'];
    $descricao= $_POST['descricao'];
    $quantidade= $_POST['quantidade'];
    $custo= $_POST['custo'];
    $preco= $_POST['preco'];

    //THE WITCH IS COMING...

    if(isset($_FILES['imagem']) && $_FILES['imagem']['error']===UPLOAD_ERR_OK){
        $imagem_temp= $_FILES['imagem']['tmp_name'];
        $imagem= file_get_contents($imagem_temp);
        $imagem_base64 = base64_encode($imagem);
    };

    //FIM BRUXARIA

    //QUERY DO BANCO
    $sql= "SELECT COUNT(pro_id) FROM produtos WHERE pro_nome= '$nome'";
    $retorno= mysqli_query($link, $sql);
    while($tbl= mysqli_fetch_array($retorno)){
        $cont= $tbl[0];

        //VERIFICA SE PRODUTO EXISTE, SE SIM, INFORMA, SE NÃO, INSERE

        if($cont ==1){
            echo"<script>window.alert('PRODUTO JÁ CADASTRADO');</script>";

        }else{
            $sql= "INSERT INTO produtos (pro_nome, pro_descricao, pro_quantidade, pro_custo, pro_preco, pro_ativo, imagem1) VALUES ('$nome', '$descricao', '$quantidade', '$custo', '$preco', 's', '$imagem_base64')";
            mysqli_query($link, $sql);
            echo"<script>window.alert('PRODUTO CADASTRADO COM SUCESSO!'); </script>";
            echo"<script>window.location.href='listaproduto.php';</script>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estiloadm.css">
    <title>CADASTRA PRODUTO</title>
</head>
<body>
<div>
    <!-- O MENU GERAL DA APLICAÇÃO -->
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

    <!-- ESTRUTURA DA PÁGINA -->
    <form action="cadastraproduto.php" method="post" enctype="multipart/form-data">
        <label>NOME DO PRODUTO</label>
        <input type="text" name="nome" id="nome">
        <br>

        <label>DESCRIÇÃO</label>
        <textarea name="descricao" id="descricao" rows="4" resize="none"></textarea>
        <br>

        <label>QUANTIDADE</label>
        <input type="number" name="quantidade" id="quantidade">
        <br>

        <label>CUSTO</label>
        <input type="decimal" name="custo" id="custo">
        <br>

        <label>PREÇO</label>
        <input type="decimal" name="preco" id="preco">

        <label>IMAGEM</label>
        <input type="file" name="imagem" id="imagem">
        <br>

        <input type="submit" name="cadastrar " id="cadastrar">

    </form>
    
</body>
</html>