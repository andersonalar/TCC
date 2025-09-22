<?php
session_start();
include_once("conexao.php");
?>
<html>
<head><title>crud -listar</title></head>
<style>
body{
background-color:gray;
color:white;
}
a{
color:white;
}



</style>

<body >
<h1>listar usuarios</h1>
<?php
if(isset($_SESSION['msg'])){
echo $_SESSION['msg'];
unset($_SESION['msg']);
}
$result_usuarios="SELECT * FROM usuario";
$resultado_usuarios=mysqli_query($conexao,$result_usuarios);
while($row_usuario=mysqLi_fetch_assoc($resultado_usuarios))
{



echo  "id:" . $row_usuario['id']. "<br>" ;
echo  "usuario:" . $row_usuario['usuario']. "<br>" ;
echo  "email:" . $row_usuario['email']. "<br>" ;
echo  "telefone:" . $row_usuario['telefone']. "<br>" ;

echo  "endereco:" . $row_usuario['endereco']. "<br>" ;





echo"<a href=alterar.html>alterar</a>       ";
echo"             <a href=excluiruser.html>excluir</a>";
echo "<br><br>";


}


?>
<a href="index.html">Voltar</a>
</body>
</html>