<?php 
require_once("../conexao.php");
@session_start();
$id_usuario = $_SESSION['id'];


$home = 'ocultar';
$configuracoes = 'ocultar';
$horarios = 'ocultar';

//grupo pessoas
$usuarios = 'ocultar';
$pacientes = 'ocultar';
$funcionarios = 'ocultar';

//grupo cadastrp
$grupo_acessos = 'ocultar';
$acessos = 'ocultar';
$cargos = 'ocultar';
$convenios = 'ocultar';
$procedimentos = 'ocultar';
$formas_pgto = 'ocultar';
$frequencias = 'ocultar';


$query = $pdo->query("SELECT * FROM usuarios_permissoes where usuario = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	for($i=0; $i < $total_reg; $i++){
        foreach ($res[$i] as $key => $value){}
		$permissao = $res[$i]['permissao'];

        $query2 = $pdo->query("SELECT * FROM acessos where id = '$permissao'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$nome = $res2[0]['nome'];
		$chave = $res2[0]['chave'];
		$id = $res2[0]['id'];



        if($chave == 'home'){
			$home = '';
		}


		if($chave == 'configuracoes'){
			$configuracoes = '';
		}


		if($chave == 'usuarios'){
			$usuarios = '';
		}


		if($chave == 'pacientes'){
			$pacientes = '';
		}

		if($chave == 'funcionarios'){
			$funcionarios = '';
		}



		if($chave == 'grupo_acessos'){
			$grupo_acessos = '';
		}

        if($chave == 'acessos'){
			$acessos = '';
		}
		if($chave == 'cargos'){
			$cargos = '';
		}

		if($chave == 'convenios'){
			$convenios = '';
		}
		if($chave == 'procedimentos'){
			$procedimentos = '';
		}

		if($chave == 'frequencias'){
			$frequencias = '';
		}

		if($chave == 'formas_pgto'){
			$formas_pgto = '';
		}

		if($chave == 'horarios'){
			$horarios = '';
		}

		
    }
}


$pag_inicial = '';
if($home != 'ocultar'){
	$pag_inicial = 'home';
}else{
	$query = $pdo->query("SELECT * FROM usuarios_permissoes where usuario = '$id_usuario'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);	
	if($total_reg > 0){

		for($i=0; $i < $total_reg; $i++){
			$permissao = $res[$i]['permissao'];		
			$query2 = $pdo->query("SELECT * FROM acessos where id = '$permissao'");
			$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);	
			
			if($res2[0]['pagina'] == 'Não'){
				continue;
			}else {
				$pag_inicial = $res2[0]['chave'];	
				break;
			}
				
		}
	}else{
		echo 'Você não tem permissão para acessar nenhuma página, acione o administrador!';
		exit();
	}
}


if ($usuarios == "ocultar" and $funcionarios == "ocultar" and $pacientes == "ocultar"){
    $menu_pessoas = 'ocultar';
} else {
    $menu_pessoas = '';
}

if($grupo_acessos == 'ocultar' and $acessos == 'ocultar' and $cargos == 'ocultar'and $convenios == 'ocultar' and $procedimentos == 'ocultar' and $frequencias == 'ocultar' and $formas_pgto == 'ocultar'){
    $menu_cadastro = 'ocultar';
} else {
     $menu_cadastro = '';
}