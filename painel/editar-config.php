<?php

$tabela = 'config';
require_once("../conexao.php");

$nome = $_POST['nome_sistema'];
$email = $_POST['email_sistema'];
$telefone = $_POST['telefone_sistema'];
$endereco = $_POST['endereco_sistema']; 
$token = $_POST['token_sistema'];
$horas_confirmacao = $_POST['horas_confirmacao_sistema'];
$instancia = $_POST['instancia_sistema'];
$comissao = $_POST['comissao_sistema'];
$marca_dagua = $_POST['marca_dagua'];






//FOTO LOGO

$caminho = '../img/foto.png';

$imagem_temp = @$_FILES['foto-logo']['tmp_name']; 

if(@$_FILES['foto-logo']['name'] != ""){
	$ext = pathinfo(@$_FILES['foto-logo']['name'], PATHINFO_EXTENSION);   
	if($ext == 'png'){ 
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}
//FOTO relatorio

$caminho = '../img/foto.jpg';

$imagem_temp = @$_FILES['foto-logo-rel']['tmp_name']; 

if(@$_FILES['foto-logo-rel']['name'] != ""){
	$ext = pathinfo(@$_FILES['foto-logo-rel']['name'], PATHINFO_EXTENSION);   
	if($ext == 'jpg'){ 
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}


// FOTO ICONE
$caminho = '../img/icone.png';

$imagem_temp = @$_FILES['foto-icone']['tmp_name']; 

if(@$_FILES['foto-icone']['name'] != ""){
	$ext = pathinfo(@$_FILES['foto-icone']['name'], PATHINFO_EXTENSION);   
	if($ext == 'png'){ 
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}



    $query = $pdo ->prepare("UPDATE $tabela SET nome = :nome, email = :email, telefone = :telefone, endereco = :endereco, token = :token, instancia = :instancia, horas_confirmacao = :horas_confirmacao, comissao = :comissao, marca_dagua = :marca_dagua where id = '1' ");


$query -> bindValue(":nome", "$nome");
$query -> bindValue(":email", "$email");
$query -> bindValue(":telefone", "$telefone");
$query -> bindValue(":endereco", "$endereco");
$query -> bindValue(":token", "$token");
$query -> bindValue(":instancia", "$instancia");
$query -> bindValue(":horas_confirmacao", "$horas_confirmacao");
$query -> bindValue(":comissao", "$comissao");
$query -> bindValue(":marca_dagua", "$marca_dagua");
$query -> execute();

echo 'Editado com Sucesso';
