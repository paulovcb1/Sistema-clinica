<?php

$tabela = 'pacientes';
require_once("../../../conexao.php");

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$data_nasc = $_POST['data_nasc'];
$endereco = $_POST['endereco']; 
$profissao = $_POST['profissao']; 
$convenio = $_POST['convenio']; 
$sexo = $_POST['sexo']; 
$obs = $_POST['obs']; 


$id = $_POST['id']; 

// validacao cpf
$query = $pdo ->query("SELECT * FROM $tabela where cpf = '$cpf' ");
$res = $query->fetchall(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if (@count ($res) > 0 and $id != $id_reg) {
    echo "CPF: $cpf já foi Cadastrado";
    exit();
}


if($id == ""){
    $query = $pdo ->prepare("INSERT INTO $tabela SET nome = :nome, telefone = :telefone, endereco = :endereco ,data_nasc = :data_nasc, data_cad = curDate(), cpf = :cpf, convenio = :convenio , profissao = :profissao, sexo = :sexo, obs = :obs ");
} else {
    $query = $pdo ->prepare("UPDATE $tabela SET nome = :nome, telefone = :telefone, endereco = :endereco ,data_nasc = :data_nasc, cpf = :cpf, convenio = :convenio , profissao = :profissao , sexo = :sexo, obs = :obs  where id = '$id' ");
}


$query -> bindValue(":nome", "$nome");
$query -> bindValue(":cpf", "$cpf");
$query -> bindValue(":telefone", "$telefone");
$query -> bindValue(":endereco", "$endereco");
$query -> bindValue(":data_nasc", "$data_nasc");
$query -> bindValue(":profissao", "$profissao");
$query -> bindValue(":convenio", "$convenio");
$query -> bindValue(":sexo", "$sexo");
$query -> bindValue(":obs", "$obs");
$query -> execute();

echo 'Salvo com Sucesso';
