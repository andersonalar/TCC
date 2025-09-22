<html>
<body>
<?php
$nome=$_POST['nome'];
include("conexao.php");
$sql="DELETE FROM contato WHERE nome='$nome'";
$resultado=mysqli_query($conexao,$sql);
if($resultado)
{
echo "excluido com sucesso";
}
else
{
echo"erro ao excluir";
}
?>
<br><br>
<a href="listarcontato.php">voltar</a>
</body>
</html>