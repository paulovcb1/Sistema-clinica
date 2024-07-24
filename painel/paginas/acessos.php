<?php
$pag = 'acessos';
?>

<a onclick="inserir()" class="btn btn-primary">
<i class="fa-solid fa-plus"></i>
Acessos
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
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Menu" required>							
						</div>

						<div class="col-md-3">							
								<label>Chave</label>
								<input type="text" class="form-control" id="chave" name="chave" placeholder="Chave" required>							
						</div>

						<div class="col-md-3">							
								<label>Grupo</label>
								<select name="grupo" id="grupo" class="form-control">
								<option value="0">Sem grupo</option>
								<?php
									$query = $pdo ->query("SELECT * FROM grupo_acessos order by id asc");
									$res = $query->fetchall(PDO::FETCH_ASSOC);
									$linhas = @count ($res);
									if( $linhas > 0){
										for ($i = 0; $i < $linhas; $i++) {
									?>
                                        <option value="<?php echo $res[$i]['id'] ?>" ><?php echo $res[$i]['nome'] ?></option>

									<?php } } else ?>

                                    </select>						
						</div>

						<div class="col-md-3" style="margin-top: 22px">							
								<button type="submit" class="btn btn-primary" >Salvar</button>							
						</div>

                        
					</div>



                    <input type="hidden" class="form-control" id="id" name="id">		


				<br>
				<small><div id="mensagem" align="center"></div></small>
			</div>
			
			</form>
		</div>
	</div>
</div>





<script type="text/javascript">
    var pag = "<?=$pag?>"
</script>
<script src="js/ajax.js"></script>