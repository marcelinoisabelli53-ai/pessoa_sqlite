
<?php
require_once __DIR__ . '/BoletoDAO.php';

$dao = new BoletoDAO();
$boletos = $dao->listar();

function h($valor) {
    return htmlspecialchars((string) ($valor ?? ''), ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Boletos</title>
</head>
<body>
    <h1>Cadastro de boletos</h1>

    <a href="cadastro.php">Cadastrar novo boleto</a>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Vencimento</th>
                <th>Emissão</th>
                <th>Pagamento</th>
                <th>Valor</th>
                <th>Desconto</th>
                <th>Juros</th>
                <th>Multa</th>
                <th>Mora</th>
                <th>Valor pago</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($boletos as $b): ?>
            <tr>
                <td><?= h($b['id']) ?></td>
                <td><?= h($b['data_vencimento']) ?></td>
                <td><?= h($b['data_emissao']) ?></td>
                <td><?= h($b['data_pagamento']) ?></td>
                <td>R$ <?= number_format((float)$b['valor'], 2, ',', '.') ?></td>
                <td>R$ <?= number_format((float)$b['desconto'], 2, ',', '.') ?></td>
                <td>R$ <?= number_format((float)$b['juros'], 2, ',', '.') ?></td>
                <td>R$ <?= number_format((float)$b['multa'], 2, ',', '.') ?></td>
                <td>R$ <?= number_format((float)$b['mora'], 2, ',', '.') ?></td>
                <td>R$ <?= number_format((float)$b['valor_pago'], 2, ',', '.') ?></td>
                <td>
                    <a href="cadastro.php?id=<?= (int)$b['id'] ?>">Editar</a>
                    |
                    <a href="acao.php?excluir=<?= (int)$b['id'] ?>"
                       onclick="return confirm('Deseja excluir este boleto?')">
                       Excluir
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
