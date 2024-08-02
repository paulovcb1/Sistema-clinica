<?php

$tabela = 'pacientes';
require_once("../../../conexao.php");
$query = $pdo->query("SELECT * FROM $tabela ORDER BY id DESC");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);

if ($linhas > 0) {
    echo <<<HTML
    <small>
        <table class="table table-hover" id="tabela">
        <thead>
        <tr> 
        <th>Nome</th>    
        <th class="esc">CPF</th>    
        <th class="esc">Telefone</th>    
        <th class="esc">Data de Nascimento</th>    
        <th class="esc">Convênio</th>    
        <th>Ações</th>
        </tr> 
        </thead> 
        <tbody>    
HTML;

    for ($i = 0; $i < $linhas; $i++) {
        $id = $res[$i]['id'];
        $nome = $res[$i]['nome'];
        $cpf = $res[$i]['cpf'];
        $endereco = $res[$i]['endereco'];
        $telefone = $res[$i]['telefone'];
        $data_cad = $res[$i]['data_cad'];
        $data_nasc = $res[$i]['data_nasc'];
        $convenio = $res[$i]['convenio'];
        $profissao = $res[$i]['profissao'];

        $data_nasc_formatada = implode('/', array_reverse(explode('-', $data_nasc)));
        $data_cad_formatada = implode('/', array_reverse(explode('-', $data_cad)));

        $query2 = $pdo->query("SELECT * FROM convenios WHERE id = '$convenio'");
        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
        $linhas2 = @count($res2);

        $nome_convenio = $linhas2 > 0 ? $res2[0]['nome'] : 'Nenhum';

        echo <<<HTML
        <tr>
            <td>
                <input type="checkbox" id="seletor-{$id}" class="form-check-input" onchange="selecionar('{$id}')">
                {$nome}
            </td>
            <td class="esc">{$cpf}</td>
            <td class="esc">{$telefone}</td>
            <td class="esc">{$data_nasc_formatada}</td>
            <td class="esc">{$nome_convenio}</td>
            <td>
                <big>
                    <a href="#" onclick="editar('{$id}','{$nome}','{$telefone}','{$endereco}','{$data_nasc_formatada}','{$cpf}','{$convenio}','{$profissao}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a>
                </big>
                <li class="dropdown head-dpdn2" style="display: inline-block;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>
                    <ul class="dropdown-menu" style="margin-left:-230px;">
                        <li>
                            <div class="notification_desc2">
                            <p>Tem certeza que deseja excluir? <a href="#" onclick="excluir('{$id}')"><span class="text-danger">Sim</span></a></p>
                            </div>
                        </li>                                        
                    </ul>
                </li>
                <big>
                    <a href="#" onclick="mostrar('{$nome}','{$telefone}','{$endereco}','{$data_nasc_formatada}','{$data_cad_formatada}','{$cpf}','{$convenio}','{$profissao}')" title="Mostrar Dados"><i class="fa fa-info-circle text-primary"></i></a>
                </big>
            </td>
        </tr>
HTML;
    }

    echo <<<HTML
        </tbody>
        <small>
            <div align="center" id="mensagem-excluir"></div>
        </small>
        </table>
    </small>
HTML;

} else {
    echo 'Nenhum Registro Encontrado!';
}

?>
<script type="text/javascript">
    var table = new DataTable('#tabela', {
        language: {
            url: '//cdn.datatables.net/plug-ins/2.1.2/i18n/pt-BR.json',
        }, "ordering": false, "stateSave": true
    });

    function editar(id, nome, telefone, endereco, data_nasc, cpf, convenio, profissao){
        $('#mensagem').text(''), 
        $('#titulo_inserir').text('Editar Registro');
        $('#id').val(id);
        $('#nome').val(nome);
        $('#telefone').val(telefone);
        $('#endereco').val(endereco);
        $('#data_nasc').val(data_nasc);
        $('#convenio').val(convenio).change();
        $('#profissao').val(profissao);
        $('#modalForm').modal('show');
    }

    function mostrar(nome, telefone, endereco, data_nasc, data_cad, cpf, convenio, profissao){

        $('#titulo_dados').text(nome);
        $('#cpf_dados').text(cpf);
        $('#telefone_dados').text(telefone);
        $('#endereco_dados').text(endereco);
        $('#data_nasc_dados').text(data_nasc);
        $('#profissao_dados').text(profissao);
        $('#convenio_dados').text(convenio);
        $('#data_cad_dados').text(data_cad);
        $('#modalDados').modal('show');
    }

    function limparCampos(){
        $('#id').val('');
        $('#nome').val('');
        $('#cpf').val('');
        $('#telefone').val('');
        $('#endereco').val('');
        $('#profissao').val('');
        $('#convenio').val('');
        $('#data_nasci').val('');
        $('#ids').val('');
        $('#btn-deletar').hide();
    }

    function selecionar(id) {
        var ids = $('#ids').val();
        if ($('#seletor-'+id).is(":checked") == true) {
            var novo_id = ids + id + '-';
            $('#ids').val(novo_id);
        } else {
            var retirar = ids.replace(id + '-', '');
            $('#ids').val(retirar);
        }
        var ids_final = $('#ids').val();
        if (ids_final != "") {
            $('#btn-deletar').show();
        } else {
            $('#btn-deletar').hide(); 
        }
    }

    function excluirSel(id){
        var ids = $('#ids').val();
        var id = ids.split("-");
        for (var i = 0; i < id.length - 1; i++) {
            excluir(id[i]);
        }
        limparCampos();
    }
</script>
