<?php

$tabela = 'frequencias';
require_once("../../../conexao.php");

$frequencia = $_POST['frequencia'];
$dias = $_POST['dias'];
$id = $_POST['id']; 


// validacao nome
$query = $pdo ->query("SELECT * FROM $tabela where frequencia = '$frequencia' ");
$res = $query->fetchall(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if (@count ($res) > 0 and $id != $id_reg) {
    echo "frequencia: $nome já foi Cadastrado";
    exit();
}



if($id == ""){
    $query = $pdo ->prepare("INSERT INTO $tabela SET frequencia = :frequencia, dias = :dias");
} else {
    $query = $pdo ->prepare("UPDATE $tabela SET frequencia = :frequencia, dias = :dias where id = '$id' ");
}


$query -> bindValue(":frequencia", "$frequencia");
$query -> bindValue(":dias", "$dias");
$query -> execute();

echo 'Salvo com Sucesso';

