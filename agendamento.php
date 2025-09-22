<?php
include("conexao.php");
$nome=$_POST["nome"];
 $servico=$_POST["servico"];
 $funcionario=$_POST["funcionario"];
 $endereco=$_POST["endereco"];
 $horario=$_POST["horario"];
 $telefone=$_POST["telefone"];
 $data=$_POST["data"];

$sql="INSERT INTO agendamentos(nome,servico,funcionario,endereco,horario,telefone,data) VALUES('$nome','$servico','$funcionario','$endereco','$horario','$telefone','$data')";
if(mysqli_query($conexao,$sql))
{
echo"agendamento cadastrado com sucesso";
}
else
{
echo "Error".$sql."<br>".mysqli_error($conexao);
}
mysqli_close($conexao);
echo '<br>';
echo"<a href=index.html>pagina inicial</a>";
?>
