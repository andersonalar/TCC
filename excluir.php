<html>
<body>
<?php
$nome=$_POST['nome'];
include("conexao.php");
$sql="DELETE FROM agendamentos WHERE nome='$nome'";
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
<a href="listarsalao.php">listar</a>
</body>
</html>