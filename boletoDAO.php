
<?php

class BoletoDAO {
    private $conn;

    public function __construct() {
        $this->conn = new PDO(
            'sqlite:' . __DIR__ . '/../persistencia/pessoas.db'
        );
        $this->conn->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
    }

    public function listar() {
        $sql = "SELECT * FROM boleto ORDER BY id DESC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obter($id) {
        $sql = "SELECT * FROM boleto WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvar($dados) {
        $sql = "INSERT INTO boleto
        (data_vencimento, data_emissao, data_pagamento,
        valor, desconto, juros, multa, mora, valor_pago)
        VALUES
        (:vencimento, :emissao, :pagamento,
        :valor, :desconto, :juros, :multa, :mora, :valor_pago)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':vencimento' => $dados['data_vencimento'],
            ':emissao' => $dados['data_emissao'],
            ':pagamento' => $dados['data_pagamento'] ?: null,
            ':valor' => $dados['valor'],
            ':desconto' => $dados['desconto'],
            ':juros' => $dados['juros'],
            ':multa' => $dados['multa'],
            ':mora' => $dados['mora'],
            ':valor_pago' => $dados['valor_pago']
        ]);
    }

    public function alterar($id, $dados) {
        $sql = "UPDATE boleto SET
        data_vencimento = :vencimento,
        data_emissao = :emissao,
        data_pagamento = :pagamento,
        valor = :valor,
        desconto = :desconto,
        juros = :juros,
        multa = :multa,
        mora = :mora,
        valor_pago = :valor_pago
        WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':vencimento' => $dados['data_vencimento'],
            ':emissao' => $dados['data_emissao'],
            ':pagamento' => $dados['data_pagamento'] ?: null,
            ':valor' => $dados['valor'],
            ':desconto' => $dados['desconto'],
            ':juros' => $dados['juros'],
            ':multa' => $dados['multa'],
            ':mora' => $dados['mora'],
            ':valor_pago' => $dados['valor_pago'],
            ':id' => $id
        ]);
    }

    public function excluir($id) {
        $stmt = $this->conn->prepare(
            "DELETE FROM boleto WHERE id = :id"
        );
        $stmt->execute([':id' => $id]);
    }
}
