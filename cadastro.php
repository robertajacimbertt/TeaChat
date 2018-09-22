<?php
echo "chegou";
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

$nomeErr = $emailErr = $senhaErr = "";
$nome = $email = $senha = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["nome"])) {
    $nomeErr = "nome é obrigatório";
  } else {
    $nome = test_input($_POST["nome"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$nome)) {
      $nomeErr = "Somente letras e espaços em branco são permitidos";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email é obrigatório";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Formato de email inválido";
    }
  }
    
  if (empty($_POST["senha"])) {
    $senhaErr = "Senha é obrigatório";
  } else {
    $senha = test_input($_POST["senha"]);
    if (preg_match("/^[a-zA-Z ]*$/",$senha)) {
      $senhaErr = "É necessário adicionar letras, caracteres e números";
    }
  }

  echo "</br>";
  echo $nome;
  echo $nomeErr;
  echo "</br>";
  echo $senha;
  echo $senhaErr;
  echo "</br>";
  echo $email;
  echo $emailErr;
  echo "</br>";
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>