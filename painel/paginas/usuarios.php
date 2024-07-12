<?php
$pag = 'usuarios';
?>

<a onclick="inserir()" class="btn btn-primary">
<i class="fa-solid fa-plus"></i>
    Novo Usuario
</a>

<div class="bs-example widget-shadow" style="padding:15px" id="listar">

</div>

<script type="text/javascript">
    var pag = "<?=$pag?>"
</script>
<script src="js/ajax.js"></script>

<script type="text/javascript">
let table = new DataTable('#tabela', {
    "language" : {
            "url" : '//cdn.datatables.net/plug-ins/1.13.2/i18n/pt-BR.json'
        },
});
</script>