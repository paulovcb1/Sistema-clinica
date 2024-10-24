<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$tabela = 'usuarios';
require_once("../../../conexao.php");

if (!isset($_POST['nome']) || !isset($_POST['email'])) {
    echo "Nome e email são obrigatórios.";
    exit();
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$nivel = $_POST['grupo'];
$endereco = $_POST['endereco']; 
$pagamento = $_POST['pagamento']; 
$atendimento = $_POST['atendimento']; 
$comissao = $_POST['comissao']; 
$senha = '123';
$senha_crip = sha1($senha);
$id = $_POST['id']; 

// Validação de email
$query = $pdo->query("SELECT * FROM $tabela WHERE email = '$email'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if (@count($res) > 0 && $id != $id_reg) {
    echo "Email: $email já foi cadastrado.";
    exit();
}

// Validação de telefone
$query = $pdo->query("SELECT * FROM $tabela WHERE telefone = '$telefone'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if (@count($res) > 0 && $id != $id_reg) {
    echo "Telefone: $telefone já foi cadastrado.";
    exit();
}

try {
    if ($id == "") {
        $query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, email = :email, senha = :senha, senha_crip = :senha_crip, nivel = :nivel, ativo = 'Sim', foto = 'sem-foto.jpg', telefone = :telefone, data = curDate(), endereco = :endereco, pagamento = :pagamento, comissao = :comissao, atendimento = :atendimento");
    } else {
        $query = $pdo->prepare("UPDATE $tabela SET nome = :nome, email = :email, senha = :senha, nivel = :nivel, foto = 'sem-foto.jpg', telefone = :telefone, endereco = :endereco, pagamento = :pagamento, comissao = :comissao, atendimento = :atendimento WHERE id = '$id'");
    }

    $query->bindValue(":nome", $nome);
    $query->bindValue(":email", $email);
    $query->bindValue(":senha", $senha);
    $query->bindValue(":senha_crip", $senha_crip);
    $query->bindValue(":nivel", $nivel);
    $query->bindValue(":telefone", $telefone);
    $query->bindValue(":endereco", $endereco);
    $query->bindValue(":pagamento", $pagamento);
    $query->bindValue(":atendimento", $atendimento);
    $query->bindValue(":comissao", $comissao);

    $query->execute();
    echo 'Salvo com Sucesso';
} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}
?>
