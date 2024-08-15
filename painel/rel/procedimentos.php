<?php
include('../../conexao.php');

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));



?>
<!DOCTYPE html>
<html>

<head>

	<style>
		@import url('https://fonts.cdnfonts.com/css/tw-cen-mt-condensed');

		@page {
			margin: 145px 20px 25px 20px;
		}

		#header {
			position: fixed;
			left: 0px;
			top: -110px;
			bottom: 100px;
			right: 0px;
			height: 35px;
			text-align: center;
			padding-bottom: 100px;
		}

		#content {
			margin-top: 0px;
		}

		#footer {
			position: fixed;
			left: 0px;
			bottom: -60px;
			right: 0px;
			height: 80px;
		}

		#footer .page:after {
			content: counter(page, my-sec-counter);
		}

		body {
			font-family: 'Tw Cen MT', sans-serif;
		}

		.marca {
			position: fixed;
			left: 50;
			top: 100;
			width: 80%;
			opacity: 8%;
		}
	</style>

</head>

<body>
	<?php
	if ($marca_dagua == 'Sim') { ?>
		<img class="marca" src="<?php echo $url_sistema ?>img/foto.jpg">
	<?php } ?>


	<div id="header">

		<div style="font-size: 10px; height: 50px;">
			<table style="width: 100%; border: 0px solid #ccc;">
				<tr>
					<td style="width: 7%; text-align: left;">
						<img style="margin-TOP: 0PX; margin-left: 7px;" id="imag" src="<?php echo $url_sistema ?>img/foto.jpg" width="120px">
					</td>
					<td style="width: 33%; text-align: left; font-size: 13px;">

					</td>
					<td style="width: 5%; text-align: center; font-size: 13px;">

					</td>
					<td style="width: 40%; text-align: right; font-size: 9px;padding-right: 10px;">
						<b><big>RELATÓRIO DE PRODUTOS</big></b><br><br> <?php echo mb_strtoupper($data_hoje) ?>
					</td>
				</tr>
			</table>
		</div>

		<br>


		<table id="cabecalhotabela" style="border-bottom-style: solid; font-size: 10px; margin-bottom:10px; width: 100%; table-layout: fixed;">
			<thead>

				<tr id="cabeca" style="margin-left: 0px; background-color:#CCC">
					<td style="width: 50%;">NOME DO PROCEDIMENTO</td>
					<td style="width: 30%;"> R$ VALOR</td>
					<td style="width: 10%;"> ATIVO</td>
					<td style="width: 10%;"> CONVÊNIO</td>
				</tr>
			</thead>
		</table>
	</div>

	<div id="footer" class="row">
		<hr style="margin-bottom: 0;">
		<table style="width:100%;">
			<tr style="width:100%;">
				<td style="width:60%; font-size: 10px; text-align: left;"><?php echo $nome_sistema ?> Telefone: <?php echo $telefone_sistema ?> Email: <?php echo $email_sistema ?></td>
				<td style="width:40%; font-size: 10px; text-align: right;">
					<p class="page">Página </p>
				</td>
			</tr>
		</table>
	</div>

	<div id="content" style="margin-top: 0;">



		<table style="width: 100%; table-layout: fixed; font-size:10px; text-transform: uppercase;">
			<thead>
			<tbody>
				<?php
				$ativos = 0;
				$inativos = 0;


				$query = $pdo->query("SELECT * FROM procedimentos order by id desc");
				$res = $query->fetchall(PDO::FETCH_ASSOC);
				$linhas = @count($res);
				if ($linhas > 0) {
					for ($i = 0; $i < $linhas; $i++) {
						$id = $res[$i]['id'];
						$nome = $res[$i]['nome'];
						$tempo = $res[$i]['tempo'];
						$valor = $res[$i]['valor'];
						$ativo = $res[$i]['ativo'];
						$convenio = $res[$i]['convenio'];


						$total_valorF = number_format($valor, 2, ',', '.');


						if ($ativo == 'Sim') {
							$icone = 'fa-check-square';
							$titulo_link = 'Desativar Usuario';
							$acao = 'Não';
							$classe_ativo = '';
							$ativos ++;
						} else {
							$icone = 'fa-square-o';
							$titulo_link = 'Ativar Usuario';
							$acao = 'Sim';
							$classe_ativo = '#c4c4c4';
							$inativos ++;
						}
						
						$classe_convenio = '';
						if($convenio == 'Não'){
							$classe_convenio = 'red';
						}

				?>


						<tr style="color:<?php echo $classe_ativo ?>">
							<td style="width:50%"><?php echo $nome ?></td>
							<td style="width:30%">R$ <?php echo $valor ?></td>
							<td style="width:10%;"><?php echo $ativo ?></td>
							<td style="width:10%; color:<?php echo $classe_convenio ?>"><?php echo $convenio ?></td>
						</tr>

				<?php }
				} ?>
			</tbody>

			</thead>
		</table>



	</div>
	<hr>
	<table>
		<thead>
		<tbody>
			<tr>
				<td style="font-size: 10px; width:180px; text-align: right;"></td>

				<td style="font-size: 10px; width:180px; text-align: right;"></td>

				<td style="font-size: 10px; width:180px; text-align: right;"></td>

				<td style="font-size: 10px; width:180px; text-align: right; padding: 5px;"><b>Total de Procedimentos: <?php echo $linhas ?>
				
				<br>
				Procedimentos Inativos: <?php echo $inativos ?>
				<br>
				Procedimentos Ativos: <?php echo $ativos ?>
					</td>

			</tr>
		</tbody>
		</thead>
	</table>

</body>

</html>