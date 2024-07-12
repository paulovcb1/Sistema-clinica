<?php
session_start();
require_once ("conexao.php");

$email =  $_POST['email'];  
$senha = $_POST['senha'];
$senha_crip = md5($senha); 

$query = $pdo ->prepare("SELECT * FROM usuarios where email = :email and senha_crip = :senha ");
$query -> bindValue(":email", "$email");
$query -> bindValue(":senha", "$senha_crip");
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


