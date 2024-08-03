<?php

$tabela = 'func_proc';
require_once("../../../conexao.php");

$procedimento = $_POST['procedimento'];

$funcionario = $_POST['id']; 


// validacao email
$query = $pdo ->query("SELECT * FROM $tabela where funcionario = '$funcionario' and procedimento = '$procedimento' ");
$res = $query->fetchall(PDO::FETCH_ASSOC);
if (@count ($res) > 0) {
    echo " O procedimento já foi Cadastrado";
    exit();
}



 $pdo ->query("INSERT INTO $tabela SET procedimento = '$procedimento', funcionario = '$funcionario'");

echo 'Salvo com Sucesso';