<?php
// CONEXÃO COM O BANCO DE DADOS
include("utils/conectadb.php");
include("utils/verificalogin.php");

// ====================== PROCESSAMENTO DO FORM ======================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // COLETA DOS CAMPOS DO FORM
    $nomecli    = $_POST['txtnome'];
    $cpfcli     = $_POST['txtcpf'];
    $telcli     = $_POST['txtcontato'];
    $datanasc   = $_POST['txtdatanasc'];  // yyyy-mm-dd
    $ativocli   = $_POST['ativo'];

    // 1) VERIFICA SE CPF JÁ EXISTE
    $sql  = "SELECT COUNT(CLI_CPF) FROM clientes WHERE CLI_CPF = '$cpfcli'";
    $env  = mysqli_query($link, $sql);
    $dup  = mysqli_fetch_array($env)[0];

    if ($dup == 1) {
        echo "<script>window.alert('CLIENTE JÁ EXISTE');</script>";
    } else {
        // 2) INSERE NOVO CLIENTE
        $sql = "INSERT INTO clientes (CLI_NOME, CLI_CPF, CLI_TEL, CLI_ATIVO, CLI_DATANASC)
                VALUES ('$nomecli', '$cpfcli', '$telcli', $ativocli, '$datanasc')";
        mysqli_query($link, $sql);

        echo "<script>window.alert('CLIENTE CADASTRADO COM SUCESSO!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/formulario.css">
    <link rel="stylesheet" href="css/global.css">
    <link href="https://fonts.cdnfonts.com/css/master-lemon" rel="stylesheet">
    <title>CADASTRO DE CLIENTE</title>
</head>
<body>
    <div class="global">

        <div class="formulario">
            <!-- Botão voltar -->
            <a href="backoffice.php" class="btn-voltar">
                <img src="icons/SETAAAA.webp" width="50" height="50" alt="Voltar">
            </a>

            <h2>CADASTRO</h2>

            <form class="login" action="cliente_cadastra.php" method="post">
                <label>NOME DO CLIENTE</label>
                <input type="text" name="txtnome" placeholder="Digite o nome completo" required>
                <br>

                <label>CPF</label>
                <input type="number" name="txtcpf" placeholder="Digite o CPF" required>
                <br>

                <label>TELEFONE</label>
                <input type="number" name="txtcontato" placeholder="Digite o telefone" required>
                <br>

                <label>DATA DE NASCIMENTO</label>
                <input type="date" name="txtdatanasc" required>
                <br><br>

                <label>STATUS DO CLIENTE:</label>
                <div class="rbativo">
                    <input type="radio" name="ativo" id="ativo" value="1" checked>
                    <label for="ativo">ATIVO</label>
                    <br>
                    <input type="radio" name="ativo" id="inativo" value="0">
                    <label for="inativo">INATIVO</label>
                </div>

                <br>
                <input type="submit" value="CADASTRAR">
            </form>

            <br>
        </div>
    </div>
</body>
</html>
