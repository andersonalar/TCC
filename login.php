<?php

$email = $_POST["email"];
$senha = $_POST["senha"];
$connect = mysql_connect("localhost","root","");
$db = mysql_select_db("salao1");
  if (isset($email)) {

    $verifica = mysql_query("SELECT * FROM usuario WHERE  senha = "$senha"") or die("erro ao selecionar");
      if (mysql_num_rows($verifica)<=0){
        echo"<script language="javascript" type="text/javascript">
        alert("Login e/ou senha incorretos");window.location
        .href="login.html";</script>";
        die();
      }else{
        setcookie("email",$email);
        header("Location:index.html");
      }
  }
?>