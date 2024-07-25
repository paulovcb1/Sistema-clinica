<?php
$pag = 'usuarios';
?>

<a onclick="inserir()" class="btn btn-primary">
<i class="fa-solid fa-plus"></i>
    Novo Usuario
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
						<span><b>Telefone: </b></span><span id="telefone_dados"></span>
					</div>


					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Email: </b></span><span id="email_dados"></span>
					</div>
				

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Senha: </b></span><span id="senha_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Nível: </b></span><span id="nivel_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Ativo: </b></span><span id="ativo_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Data Cadastro: </b></span><span id="data_dados"></span>
					</div>

					<div class="col-md-12" style="margin-bottom: 5px">
						<span><b>Endereço: </b></span><span id="endereco_dados"></span>
					</div>
                    <div class="col-md-12" style="margin-bottom: 5px">
						<div align="center"><img src="" id="foto_dados" width="25%" ></div>
					</div>
			</div>



			</div>
		</div>
	</div>
</div>



<!-- Modal Permissoes -->
<div class="modal fade" id="modalPermissoes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="nome_permissoes"></span>
					<span style="position:absolute; right:35px">
							<input class="form-check-input" type="checkbox" id="input-todos" onchange="marcarTodos()">
							<label class="" >Marcar Todos</label>
					</span>
				</h4>

				<button id="btn-fechar-permissoes" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row" id="listar_permissoes">


				</div>
				<br>
				<input type="hidden" name="id" id="id_permissoes">
				<small>
					<div id="mensagem_permissao" align="center" class="mt-3" >

					</div>
				</small>
			</div>
		</div>
	</div>
</div>




<!-- Modal Perfil -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
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
						<div class="col-md-6">							
								<label>Nome</label>
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Seu Nome" required>							
						</div>

						<div class="col-md-6">							
								<label>Email</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Seu Nome" required>							
						</div>

                        
					</div>


					<div class="row">
						<div class="col-md-6">							
								<label>Telefone</label>
								<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Seu Telefone" required>							
						</div>
                            
                        <div class="col-md-6">							
								<label>Nivel</label>
                                    <select name="nivel" id="nivel" class="form-control">
                                        <option selected>Administrador</option>
                                        <option selected>Recepcionista</option>
                                        <option selected>Dentista</option>
                                    </select>
						</div>


					<div class="row">
						<div class="col-md-12">							
                                    <label>Endereco</label>
                                    <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereco">
						</div>
					</div>



                    <input type="hidden" class="form-control" id="id" name="id">		


				<br>
				<small><div id="mensagem" align="center"></div></small>
			</div>
			<div class="modal-footer">       
				<button type="submit" class="btn btn-primary">Salvar</button>
			</div>
			</form>
		</div>
	</div>
</div>







<script type="text/javascript">
    var pag = "<?=$pag?>"
</script>
<script src="js/ajax.js"></script>

<script>
	function adicionarPermissao (id, usuario){
            $.ajax({
            url: 'paginas/' + pag + "/add_permissao.php",
            method: 'POST',
            data: {id, usuario},
            dataType: "html",

            success:function(result){
                listarPermissoes(usuario);
        }
    });

        }

		function marcarTodos(){
		let checkbox = document.getElementById('input-todos');
		var usuario = $('#id').val();
		
		if(checkbox.checked) {
		    adicionarPermissoes(usuario);		    
		} else {
		    limparPermissoes(usuario);
		}
	}

		function adicionarPermissoes (id_usuario){
			var id_usuario = $("#id_permissoes").val();
            $.ajax({
            url: 'paginas/' + pag + "/add_permissoes.php",
            method: 'POST',
            data: {id_usuario},
            dataType: "html",

            success:function(result){
                listarPermissoes(id_usuario);
        }
    });

        }


		function limparPermissoes (id_usuario) {
				$.ajax({
				url: 'paginas/' + pag + "/limpar_permissoes.php",
				method: 'POST',
				data: {id_usuario},
				dataType: "html",

				success:function(result){
				listarPermissoes(id_usuario);
			}
		});

	}
		
</script>
