<?php
session_start();
//Estrutura de dados para guardar os usuários. ps: obviamente a melhor opção era usar um DB, mas como esse é meu primeiro projeto em PHP resolvi deixa-lo assim.
$usuarios_cadastrados = [['id' => 1, 'email' => 'adm@teste.com.br', 'senha' => '1234', 'adm' => true], ['id' => 2, 'email' => 'felipe@teste.com.br', 'senha' => 'abc', 'adm' => false], ['id' => 3, 'email' => 'corno@teste.com.br', 'senha' => '1234', 'adm' => true]];
$autenticador = false;
$id = null;
$adm = false;

//Varre a lista de usuários checando se o login feito existe
foreach ($usuarios_cadastrados as $users) {
	if($_POST['email'] === $users['email'] && $_POST['senha'] === $users['senha']){
		$autenticador = true;
		$id = $users['id'];
		$adm = $users['adm'];
	}
}

//Autentica o login e redireciona o ususario
if($autenticador){
	$_SESSION['autenticador'] = 'SIM';
	$_SESSION['id'] = $id;
	$_SESSION['adm'] = $adm;
	header('Location: home.php');
}else{
	$_SESSION['autenticador'] = 'NAO';
	header('Location: index.php?nome=erro');
}


?>