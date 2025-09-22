<?php
class Carrinho
{
    public $nome;
    // public $quantidade = 1;
    public $valor;
    public $id;

    function __construct($nome, $valor, $id)
    {
        $this->nome = $nome;
        // $this->quantidade = $quantidade;
        $this->valor = $valor;
        $this->id = $id;
    }

    public function getCarrinho()
    {
        if (isset($_SESSION['carrinho'][$this->id])) {
            $_SESSION['carrinho'][$this->id]['quantidade']++;
        } else {
            $_SESSION['carrinho'][$this->id] = [
                "nome" => "{$this->nome}",
                "quantidade" => 1,
                "valor" => "{$this->valor}"
            ];
        }

        // print_r($_SESSION['carrinho']);

        foreach ($_SESSION['carrinho'] as $key => $value) {
            echo "<p>
                     <strong>Produto:</strong> " . $value['nome'] . " | 
                     <strong>Valor:</strong> " . $value['valor'] . " | 
                     <strong>Quantidade:</strong> " . $value['quantidade'] . 
                 "</p>";
        }
    }
}
