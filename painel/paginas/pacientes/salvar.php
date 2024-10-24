<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$tabela = 'pacientes';
require_once("../../../conexao.php");

if (!isset($_POST['nome']) || !isset($_POST['cpf'])) {
    echo "Nome e CPF são obrigatórios.";
    exit();
}

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$data_nasc = $_POST['data_nasc'];
$endereco = $_POST['endereco'];
$profissao = $_POST['profissao'];
$convenio = $_POST['convenio'];
$sexo = isset($_POST['sexo']) ? $_POST['sexo'] : NULL; // Define NULL se sexo não estiver setado
$obs = $_POST['obs'];
$id = $_POST['id'];

// Validação do CPF (pode incluir mais validações se necessário)
$query = $pdo->query("SELECT * FROM $tabela WHERE cpf = '$cpf'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if (count($res) > 0 && $id != $res[0]['id']) {
    echo "CPF: $cpf já foi cadastrado.";
    exit();
}

// Validação do telefone
$query = $pdo->query("SELECT * FROM $tabela WHERE telefone = '$telefone'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if (count($res) > 0 && $id != $res[0]['id']) {
    echo "Telefone: $telefone já foi cadastrado.";
    exit();
}

try {
    if ($id == "") {
        $query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, telefone = :telefone, endereco = :endereco, data_nasc = :data_nasc, data_cad = CURDATE(), cpf = :cpf, convenio = :convenio, profissao = :profissao, sexo = :sexo, obs = :obs");
    } else {
        $query = $pdo->prepare("UPDATE $tabela SET nome = :nome, telefone = :telefone, endereco = :endereco, data_nasc = :data_nasc, cpf = :cpf, convenio = :convenio, profissao = :profissao, sexo = :sexo, obs = :obs WHERE id = :id");
        $query->bindValue(":id", $id);
    }

    $query->bindValue(":nome", $nome);
    $query->bindValue(":cpf", $cpf);
    $query->bindValue(":telefone", $telefone);
    $query->bindValue(":endereco", $endereco);
    $query->bindValue(":data_nasc", $data_nasc);
    $query->bindValue(":profissao", $profissao);
    $query->bindValue(":convenio", $convenio);
    $query->bindValue(":sexo", $sexo);
    $query->bindValue(":obs", $obs);

    $query->execute();
    echo 'Salvo com Sucesso';
} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}
?>
