<html>
<body>
<?php
$usuario=$_POST['usuario'];
include("conexao.php");
$sql="DELETE FROM usuario WHERE usuario='$usuario'";
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
<a href="listaruser.php">listar</a>
</body>
</html>