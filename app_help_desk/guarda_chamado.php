<?php
	//Verifica se o novo chamado é valido, se sim o guarda o arquivo 'consultas.hd' e redireciona o usuário para página de sucesso ou página de erro.
	session_start();
	if($_POST['titulo'] === '' || $_POST['categoria'] === '' || $_POST['descricao'] === ''){
		header('Location: abrir_chamado.php?resultado=erro');
	}else{
		$arquivo = fopen('consultas.hd', 'a');
		fwrite($arquivo, $_SESSION['id'] . PHP_EOL);
		foreach ($_POST as $textos) {
			fwrite($arquivo, $textos . PHP_EOL);
		}
		fclose($arquivo);
		header('Location: abrir_chamado.php?resultado=sucesso');
	}
?>