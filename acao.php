
<?php

require_once __DIR__ . '/BoletoDAO.php';

$dao = new BoletoDAO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = [
        'data_vencimento' => $_POST['data_vencimento'],
        'data_emissao' => $_POST['data_emissao'],
        'data_pagamento' => $_POST['data_pagamento'] ?? '',
        'valor' => $_POST['valor'],
        'desconto' => $_POST['desconto'],
        'juros' => $_POST['juros'],
        'multa' => $_POST['multa'],
        'mora' => $_POST['mora'],
        'valor_pago' => $_POST['valor_pago']
    ];

    if (!empty($_POST['id'])) {
        $dao->alterar((int) $_POST['id'], $dados);
    } else {
        $dao->salvar($dados);
    }

    header('Location: index.php');
    exit;
}

if (isset($_GET['excluir'])) {
    $dao->excluir((int) $_GET['excluir']);
    header('Location: index.php');
    exit;
}
