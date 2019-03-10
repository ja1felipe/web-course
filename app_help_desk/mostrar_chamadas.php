<?php 

//abre o arquivo 'consultas.hd' e guarda em um array os chamados que seram exibidos na página consultar_chamado.php
$arquivo = fopen('consultas.hd', 'r');
$chamados = [];
while (!feof($arquivo)){
	$id = fgets($arquivo);
	$titulo = fgets($arquivo);
	$categoria = fgets($arquivo);
	$descricao = fgets($arquivo);
	//verifica se o usuário é administrador ou não, se for ele terá acesso a todos os chamados, se não ele terá acesso apenas aos chamados criados por o mesmo.
	if($_SESSION['adm'] && $id != ''){
		$chamados[] = [$titulo, $categoria, $descricao];
	}else{
		if ($_SESSION['id'] == $id) {
			$chamados[] = [$titulo, $categoria, $descricao];
		}
	}
}


?>
<?php
//imprime todos chamados visíveis do usuário na página consultar_chamados.php
for ($i=0; $i < count($chamados); $i++) {?>
	<div class="card mb-3 bg-light">
		<div class="card-body">
			<h5 class="card-title"><?php echo $chamados[$i][0];?></h5>
			<h6 class="card-subtitle mb-2 text-muted"><?php echo $chamados[$i][1];?></h6>
			<p class="card-text"><?php echo $chamados[$i][2];?></p>
		</div>
	</div>
<?php } fclose($arquivo); ?>