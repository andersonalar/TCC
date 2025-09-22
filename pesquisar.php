<?php

$servidor="localhost";
$usuario="root";
$senha="";
$dbname="salao1";
$conexao=mysqli_connect($servidor,$usuario,$senha,$dbname);
$pesquisar=$_POST['pesquisar'];
$result_cursos="SELECT * FROM agendamentos WHERE nome LIKE '%$pesquisar%' LIMIT 5";
$resultado_cursos=mysqli_query($conexao,$result_cursos);
while($rows_cursos=mysqli_fetch_array($resultado_cursos)){
echo "id : ".$rows_cursos['id']."<br>";
echo "nome : ".$rows_cursos['nome']."<br>";
echo "servico : ".$rows_cursos['servico']."<br>";
echo "funcionario : ".$rows_cursos['funcionario']."<br>";
echo "endereco : ".$rows_cursos['endereco']."<br>";
echo "horario : ".$rows_cursos['horario']."<br>";
echo "telefone: ".$rows_cursos['telefone']."<br>";
echo "data: ".$rows_cursos['data']."<br>";




}
?>
<a href="index.html">voltar</a>