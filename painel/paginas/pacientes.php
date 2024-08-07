<?php
$pag = 'pacientes';


if (@$pacientes == 'ocultar') {
	echo "<script> window.location='../index.php' </script>";
	exit();
}
?>
<div class="main-page margin-mobile">
	<a onclick="inserir()" class="btn btn-primary">
		<i class="fa-solid fa-plus"></i>
		Novo Paciente
	</a>

	<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle" id="btn-deletar" style="display:none">
			<i class="fa-solid fa-trash"></i>
			DELETAR
		</a>
		<ul class="dropdown-menu">
			<li>
				<div class="notification_desc2">
					<p>Tem certeza que deseja excluir? <a href="#" onclick="excluirSel()"><span class="text-danger">Sim</span></a></p>
				</div>
			</li>
		</ul>
	</li>


	<div class="bs-example widget-shadow" style="padding:15px" id="listar">

	</div>
</div>

<input type="hidden" id="ids">

<!-- Modal Dados -->
<div class="modal fade" id="modalDados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_dados"></span></h4>
				<button id="btn-fechar-dados" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row" style="margin-top: 0px">


					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>CPF: </b></span><span id="cpf_dados"></span>
					</div>


					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Telefone: </b></span><span id="telefone_dados"></span>
					</div>


					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Data Nascimento: </b></span><span id="data_nasc_dados"></span>
					</div>


					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Data Cadastro: </b></span><span id="data_cad_dados"></span>
					</div>

					<div class="col-md-12" style="margin-bottom: 5px">
						<span><b>Endereço: </b></span><span id="endereco_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Profissão: </b></span><span id="profissao_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Sexo: </b></span><span id="sexo_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Observações: </b></span><span id="obs_dados"></span>
					</div>



				</div>



			</div>
		</div>
	</div>
</div>







<!-- Modal Perfil -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form">
				<div class="modal-body">


					<div class="row">
						<div class="col-md-3">
							<label>Nome</label>
							<input type="text" class="form-control" id="nome" name="nome" placeholder="Seu Nome" required>
						</div>





						<div class="col-md-3">
							<label>CPF: </label>
							<input type="text" class="form-control" id="cpf" name="cpf" placeholder="Seu CPF" required>
						</div>


						<div class="col-md-3">
							<label>Telefone</label>
							<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Seu Telefone" required>
						</div>

						<div class="col-md-3">
							<label>Data de Nascimento</label>
							<input type="date" class="form-control" id="data_nasc" name="data_nasc" required>
						</div>

					</div>


					<div class="row">
						<div class="col-md-6">
							<label>Endereco</label>
							<input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereco">
						</div>

						<div class="col-md-6">
							<label>Convênio</label>
							<select name="convenio" id="convenio" class="form-control" required>
								<option value="0">Nenhum Convênio</option>
								<?php
								$query = $pdo->query("SELECT * FROM convenios order by id asc");
								$res = $query->fetchall(PDO::FETCH_ASSOC);
								$linhas = @count($res);
								if ($linhas > 0) {
									for ($i = 0; $i < $linhas; $i++) {
								?>
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

								<?php }
								} ?>
							</select>
						</div>


					</div>


					<div class="row">

						<div class="col-md-6">
							<label>Profissão</label>
							<input type="text" class="form-control" id="profissao" name="profissao" placeholder="Profissão">
						</div>

						<div class="col-md-6">
							<label> Sexo</label>
							<select class="form-control" name="sexo" id="sexo">
								<option value="Feminino">Feminino</option>
								<option value="Masculino">Masculino</option>
							</select>
						</div>


						<div class="row">
							<div class="col-md-12">
								<label>Observações</label>
								<textarea class="form-control" name="obs" id="obs" placeholder="Observacoes do paciente"></textarea>
							</div>

						</div>
					</div>



					<input type="hidden" class="form-control" id="id" name="id">


					<br>
					<small>
						<div id="mensagem" align="center"></div>
					</small>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>







<script type="text/javascript">
	var pag = "<?= $pag ?>"
</script>
<script src="js/ajax.js"></script>