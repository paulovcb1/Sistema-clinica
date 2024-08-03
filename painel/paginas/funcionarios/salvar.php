<?php

$tabela = 'usuarios';
require_once("../../../conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$nivel = $_POST['nivel'];
$endereco = $_POST['endereco'];
$pagamento = $_POST['pagamento'];
$atendimento = $_POST['atendimento'];
$comissao = $_POST['comissao'];
$senha_crip = sha1($senha);

$cpf = $_POST['cpf'];
$intervalo = $_POST['intervalo'];
$id = $_POST['id'];


// validacao email
$query = $pdo->query("SELECT * FROM $tabela where email = '$email' ");
$res = $query->fetchall(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if (@count($res) > 0 and $id != $id_reg) {
    echo "Email: $email já foi Cadastrado";
    exit();
}


//validacao telefone evita duplicidade de dados
$query = $pdo->query("SELECT * FROM $tabela where telefone = '$telefone' ");
$res = $query->fetchall(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if (@count($res) > 0 and $id != $id_reg) {
    echo "Telefone: $telefone já foi Cadastrado";
    exit();
}

if ($id == "") {
    $query = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, email = :email, senha =  '$senha', senha_crip = '$senha_crip', nivel = '$nivel', ativo = 'Sim', foto = 'sem-foto.jpg', telefone = :telefone, data = curDate(), endereco = :endereco, pagamento = :pagamento, comissao = :comissao, atendimento = :atendimento, cpf = :cpf, intervalo = :intervalo");
} else {
    $query = $pdo->prepare("UPDATE $tabela SET nome = :nome, email = :email, senha =  '$senha', nivel = '$nivel', foto = 'sem-foto.jpg', telefone = :telefone, endereco = :endereco , pagamento = :pagamento, comissao = :comissao, atendimento = :atendimento , cpf = :cpf, intervalo = :intervalo where id = '$id' ");
}


$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":endereco", "$endereco");
$query->bindValue(":pagamento", "$pagamento");
$query->bindValue(":atendimento", "$atendimento");
$query->bindValue(":comissao", "$comissao");
$query->bindValue(":intervalo", "$intervalo");
$query->bindValue(":cpf", "$cpf");
$query->execute();

echo 'Salvo com Sucesso';
