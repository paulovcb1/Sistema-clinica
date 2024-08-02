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
$convenio = $_POST['convenio']; 


$id = $_POST['id']; 
// validacao email
$query = $pdo ->query("SELECT * FROM $tabela where cpf = '$cpf' ");
$res = $query->fetchall(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if (@count ($res) > 0 and $id != $id_reg) {
    echo "Email: $cpf já foi Cadastrado";
    exit();
}


if($id == ""){
    $query = $pdo ->prepare("INSERT INTO $tabela SET nome = :nome, telefone = :telefone, endereco = :endereco ,data_nasc = :data_nasc, data_cad = curDate(), cpf = :cpf, convenio = :convenio , profissao = :profissao ");
} else {
    $query = $pdo ->prepare("UPDATE $tabela SET nome = :nome, telefone = :telefone, endereco = :endereco ,data_nasc = :data_nasc, cpf = :cpf, convenio = :convenio , profissao = :profissao  where id = '$id' ");
}


$query -> bindValue(":nome", "$nome");
$query -> bindValue(":cpf", "$cpf");
$query -> bindValue(":telefone", "$telefone");
$query -> bindValue(":endereco", "$endereco");
$query -> bindValue(":data_nasc", "$data_nasc");
$query -> bindValue(":profissao", "$profissao");
$query -> bindValue(":convenio", "$convenio");
$query -> execute();

echo 'Salvo com Sucesso';

// $tabela = 'usuarios';
// require_once("../../../conexao.php");

// $nome = $_POST['nome'];
// $email = $_POST['email'];
// $telefone = $_POST['telefone'];
// $nivel = $_POST['nivel'];
// $endereco = $_POST['endereco']; 
// $senha = '123';
// $senha_crip = md5($senha);
// $id = $_POST['id']; 


// //validacao email
// $query = $pdo ->query("SELECT * FROM $tabela where email = '$email' ");
// $res = $query->fetchall(PDO::FETCH_ASSOC);
// $id_reg = @$res[0]['id'];
// if (@count ($res) > 0 and $id != $id_reg) {
//     echo "Email: $email já foi Cadastrado";
//     exit();
// }
// //validacao telefone evita duplicidade de dados
// $query = $pdo ->query("SELECT * FROM $tabela where telefone = '$telefone' ");
// $res = $query->fetchall(PDO::FETCH_ASSOC);
// $id_reg = @$res[0]['id'];
// if (@count ($res) > 0 and $id != $id_reg) {
//     echo "Telefone: $telefone já foi Cadastrado";
//     exit();
// }

// if($id == ""){
//     $query = $pdo->prepare("INSERT INTO $tabela (nome, email, senha, senha_crip, nivel, ativo, foto, telefone, data, endereco) VALUES (:nome, :email, :senha, :senha_crip, :nivel, 'Sim', 'sem-foto.jpg', :telefone, curDate(), :endereco)");
// } else {
//     $query = $pdo->prepare("UPDATE $tabela SET nome = :nome, email = :email, nivel = :nivel, telefone = :telefone, endereco = :endereco WHERE id = '$id' ");
// }


// $query->bindValue(":nome", $nome);
// $query->bindValue(":email", $email);
// $query->bindValue(":senha", $senha);
// $query->bindValue(":senha_crip", $senha_crip);
// $query->bindValue(":nivel", $nivel);
// $query->bindValue(":telefone", $telefone);
// $query->bindValue(":endereco", $endereco);

// $query->execute();

// echo 'Salvo com Sucesso';
