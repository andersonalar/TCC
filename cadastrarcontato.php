<?php
include("conexao.php");
$nome=$_POST["nome"];
 $email=$_POST["email"];
 $assunto=$_POST["assunto"];
 

$sql="INSERT INTO contato(nome,email,assunto) VALUES('$nome','$email',        '$assunto')";
if(mysqli_query($conexao,$sql))
{
echo"contato realizado com sucesso";
}
else
{
echo "Error".$sql."<br>".mysqli_error($conexao);
}
mysqli_close($conexao);
echo '<br>';
echo"<a href=index.html>pagina inicial</a>";
?>