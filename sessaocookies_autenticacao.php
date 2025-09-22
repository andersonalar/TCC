<?php
session_start();
include("conexao.php");

$senha = $_POST["senha"];
$email = $_POST["email"];

$sql = "SELECT usuario FROM usuario WHERE email='$email' AND senha='$senha'";
$resultado = mysqli_query($conexao, $sql);
$linhas = mysqli_affected_rows($conexao);

if ($linhas > 0) {
    $_SESSION["usuario"] = $email;
    header("Location: sessaocokies_conteudosigiloso.php");
    exit();
} else {
    echo "Usuário ou senha inválidos.";
}
?>
