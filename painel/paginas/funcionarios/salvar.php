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
$senha = 123;
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

if($atendimento == 'Sim' and $id == "" and $token_sistema != ""){
    //envio api whatsapp
	
		$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);

		$mensagem = '*'.$nome_sistema.'* %0A';
		$mensagem .= 'Você foi cadastrado em nosso sistema  %0A';
		$mensagem .= '*Email:* '.$email.' %0A%0A';	
		$mensagem .= '*Senha:* '.$senha.' %0A%0A';	
		$mensagem .= '_Faça seu acesso e troque sua senha_%0A';	
		$mensagem .= '*Link do sistema:* '.$url_sistema.' %0A%0A';	
		$mensagem .= '_Mandaremos o contrato em PDF_ %0A';

		require("../../apis/texto.php");
}
