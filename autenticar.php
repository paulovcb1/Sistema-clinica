<?php
session_start();
require_once ("conexao.php");

$email =  $_POST['email'];  
$senha = $_POST['senha'];

$query = $pdo ->prepare("SELECT * FROM usuarios where email = :email and senha = :senha ");
$query -> bindValue(":email", "$email");
$query -> bindValue(":senha", "$senha");
$query -> execute();

$res = $query->fetchall(PDO::FETCH_ASSOC);
$linhas = count ($res);

if ($linhas > 0) {
    $_SESSION['nome'] = $res[0] ['nome'];
    $_SESSION['id'] = $res[0] ['id'];
    $_SESSION['nivel'] = $res[0] ['nivel'];

    echo "<script>window.location='painel'</script>";
}   else {
    echo "<script>window.alert('Dados incorrentos!!')</script>";
    echo "<script>window.location='index.php'</script>";
}


