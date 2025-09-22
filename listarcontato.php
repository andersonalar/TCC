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
<h1>listar contatos</h1>
<?php
if(isset($_SESSION['msg'])){
echo $_SESSION['msg'];
unset($_SESION['msg']);
}
$result_usuarios="SELECT * FROM contato";
$resultado_usuarios=mysqli_query($conexao,$result_usuarios);
while($row_usuario=mysqLi_fetch_assoc($resultado_usuarios))
{



echo  "id:" . $row_usuario['id']. "<br>" ;
echo  "nome:" . $row_usuario['nome']. "<br>" ;
echo  "email:" . $row_usuario['email']. "<br>" ;

echo  "assunto  :".   $row_usuario['assunto']."<br>";



echo"<a href=alterar.html>alterar</a>       ";
echo"             <a href=excluircontato.html>excluir</a>";
echo "<br><br>";


}


?>
<a href="index.html">Voltar</a>
</body>
</html>