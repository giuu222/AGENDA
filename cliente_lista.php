<?php
// CONEXÃO COM O BANCO
include("utils/conectadb.php");
include("utils/verificalogin.php");

// TRAZ OS CLIENTES DO BANCO
$sqlcli = "SELECT * FROM clientes";
$enviaquery = mysqli_query($link, $sqlcli);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/lista.css">

    <title>LISTA CLIENTES</title>
</head>
<body>
    <div class='global'>
        <div class='tabela'>

            <!-- BOTÃO VOLTAR FIXO -->
            <a href="backoffice.php" class="btn-voltar">
                <img src='icons/SETAAAA.webp' width="50" height="50" alt="Voltar">
            </a>

            <h2>LISTA DE CLIENTES</h2>

            <table>
                <tr>
                    <th>ID CLIENTE</th>
                    <th>NOME</th>
                    <th>CPF</th>
                    <th>CONTATO</th>
                    <th>DATA DE NASCIMENTO</th>
                    <th>STATUS</th>
                </tr>

                <!-- COMEÇOU O PHP -->
                <?php
                while ($tbl = mysqli_fetch_array($enviaquery)) {
                ?>

                <tr>
                    <td><?= $tbl['CLI_ID'] ?></td>
                    <td><?= $tbl['CLI_NOME'] ?></td>
                    <td><?= $tbl['CLI_CPF'] ?></td>
                    <td><?= $tbl['CLI_TEL'] ?></td>
                    <td><?= date('d/m/Y', strtotime($tbl['CLI_DATANASC'])) ?></td>
                    <td><?= ($tbl['CLI_ATIVO'] == 1) ? 'ATIVO' : 'INATIVO' ?></td>
                </tr>

                <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
