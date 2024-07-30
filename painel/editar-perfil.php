<?php

$tabela = 'usuarios';
require_once("../conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$conf_senha = $_POST['conf_senha'];
$endereco = $_POST['endereco_senha']; 
$senha = $_POST['senha'];
$senha_crip = sha1($senha);
$id = $_POST['id_usuario']; 


if($conf_senha != $senha){
    echo'As senha não são iguais!';
    exit();
}




// validacao email
$query = $pdo ->query("SELECT * FROM $tabela where email = '$email' ");
$res = $query->fetchall(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if (@count ($res) > 0 and $id != $id_reg) {
    echo "Email: $email já foi Cadastrado";
    exit();
}
//validacao telefone evita duplicidade de dados
$query = $pdo ->query("SELECT * FROM $tabela where telefone = '$telefone' ");
$res = $query->fetchall(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if (@count ($res) > 0 and $id != $id_reg) {
    echo "Telefone: $telefone já foi Cadastrado";
    exit();
}



//validar troca da foto
$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto = $res[0]['foto'];
}else{
	$foto = 'sem-foto.jpg';
}



//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = 'images/perfil/' .$nome_img;

$imagem_temp = @$_FILES['foto']['tmp_name']; 

if(@$_FILES['foto']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 
	
			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-foto.jpg"){
				@unlink('images/perfil/'.$foto);
			}

			$foto = $nome_img;
		
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}



    $query = $pdo ->prepare("UPDATE $tabela SET nome = :nome, email = :email, senha = :senha, senha_crip = '$senha_crip', foto = '$foto', telefone = :telefone, endereco = :endereco where id = '$id' ");


$query -> bindValue(":nome", "$nome");
$query -> bindValue(":email", "$email");
$query -> bindValue(":telefone", "$telefone");
$query -> bindValue(":endereco", "$endereco");
$query -> bindValue(":senha", "$senha");
$query -> execute();

echo 'Editado com Sucesso';
