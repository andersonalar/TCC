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
<h1>listar agendamentos</h1>
<?php
if(isset($_SESSION['msg'])){
echo $_SESSION['msg'];
unset($_SESION['msg']);
}
$result_usuarios="SELECT * FROM agendamentos";
$resultado_usuarios=mysqli_query($conexao,$result_usuarios);
while($row_usuario=mysqLi_fetch_assoc($resultado_usuarios))
{



echo  "id:" . $row_usuario['id']. "<br>" ;
echo  "nome:" . $row_usuario['nome']. "<br>" ;

echo  "servico   :".   $row_usuario['servico']."<br>";
echo  "funcionario:" . $row_usuario['funcionario']. "<br>" ;

echo  "endereco    :".   $row_usuario['endereco']."<br>";
echo  "horario" . $row_usuario['horario']. "<br>" ;

echo  "telefone    :".   $row_usuario['telefone']."<br>";
echo  "data    :".   $row_usuario['data']."<br>";


echo"<a href=alterar.html>alterar</a>       ";
echo"             <a href=excluir.html>excluir</a>";
echo "<br><br>";


}


?>
<a href="index.html">Voltar</a>
</body>
</html>