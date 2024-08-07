<?php

$tabela = 'procedimentos';
require_once("../../../conexao.php");

$nome = $_POST['nome'];
$valor = $_POST['valor'];
$tempo = $_POST['tempo'];
$valor = str_replace(',', '.', $valor);
$id = $_POST['id']; 
$convenio = $_POST['convenio']; 


// validacao nome
$query = $pdo ->query("SELECT * FROM $tabela where nome = '$nome' ");
$res = $query->fetchall(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if (@count ($res) > 0 and $id != $id_reg) {
    echo "Procedimentos $nome já foi Cadastrado";
    exit();
}




if($id == ""){
    $query = $pdo ->prepare("INSERT INTO $tabela SET nome = :nome, valor = :valor, tempo =  '$tempo', ativo = 'Sim', convenio = '$convenio' ");
} else {
    $query = $pdo ->prepare("UPDATE $tabela SET nome = :nome, valor = :valor, tempo =  '$tempo', convenio = '$convenio' where id = '$id' ");
}


$query -> bindValue(":nome", "$nome");
$query -> bindValue(":valor", "$valor");
$query -> execute();

echo 'Salvo com Sucesso';
