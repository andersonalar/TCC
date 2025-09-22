<?php
include("conexao.php");
$usuario=$_POST["usuario"];
 $email=$_POST["email"];
 $senha=$_POST["senha"];
 $telefone=$_POST["telefone"];
 $endereco=$_POST["endereco"];

$sql="INSERT INTO usuario(usuario,email,senha,telefone,endereco) VALUES('$usuario','$email',        '$senha'          ,'$telefone','$endereco')";
if(mysqli_query($conexao,$sql))
{
echo"usuario cadastrado com sucesso";
}
else
{
echo "Error".$sql."<br>".mysqli_error($conexao);
}
mysqli_close($conexao);
echo '<br>';
echo"<a href=index.html>pagina inicial</a>";
?>
