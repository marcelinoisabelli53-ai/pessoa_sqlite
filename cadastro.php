
<?php
require_once __DIR__ . '/BoletoDAO.php';

$dao = new BoletoDAO();
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$boleto = $id ? $dao->obter($id) : [];

function valorCampo($nome, $boleto) {
    return htmlspecialchars($boleto[$nome] ?? '', ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de boletos</title>
</head>
<body>
    <h1><?= $id ? 'Editar boleto' : 'Cadastrar boleto' ?></h1>

    <form action="acao.php" method="POST">
        <input type="hidden" name="id" value="<?= $id ?>">

        <label>Data de vencimento:</label>
        <input type="date" name="data_vencimento"
            value="<?= valorCampo('data_vencimento', $boleto) ?>" required>
        <br><br>

        <label>Data de emissão:</label>
        <input type="date" name="data_emissao"
            value="<?= valorCampo('data_emissao', $boleto) ?>" required>
        <br><br>

        <label>Data de pagamento:</label>
        <input type="date" name="data_pagamento"
            value="<?= valorCampo('data_pagamento', $boleto) ?>">
        <br><br>

        <label>Valor:</label>
        <input type="number" name="valor" step="0.01" min="0"
            value="<?= valorCampo('valor', $boleto) ?>" required>
        <br><br>

        <label>Desconto:</label>
        <input type="number" name="desconto" step="0.01" min="0"
            value="<?= valorCampo('desconto', $boleto) ?>" required>
        <br><br>

        <label>Juros:</label>
        <input type="number" name="juros" step="0.01" min="0"
            value="<?= valorCampo('juros', $boleto) ?>" required>
        <br><br>

        <label>Multa:</label>
        <input type="number" name="multa" step="0.01" min="0"
            value="<?= valorCampo('multa', $boleto) ?>" required>
        <br><br>

        <label>Mora:</label>
        <input type="number" name="mora" step="0.01" min="0"
            value="<?= valorCampo('mora', $boleto) ?>" required>
        <br><br>

        <label>Valor pago:</label>
        <input type="number" name="valor_pago" step="0.01" min="0"
            value="<?= valorCampo('valor_pago', $boleto) ?>" required>
        <br><br>

        <button type="submit">Salvar boleto</button>
        <a href="index.php">Voltar</a>
    </form>
</body>
</html>
