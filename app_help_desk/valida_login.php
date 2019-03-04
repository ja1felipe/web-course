<?php
session_start();
$usuarios_cadastrados = [['email' => 'adm@teste.com.br', 'senha' => '1234'], ['email' => 'felipe@teste.com.br', 'senha' => 'abc']];
$autenticador = false;
foreach ($usuarios_cadastrados as $users) {
	if($_POST['email'] === $users['email'] && $_POST['senha'] === $users['senha']){
		$autenticador = true;
	}
}

if($autenticador){
	$_SESSION['autenticador'] = 'SIM';
	header('Location: home.php');
}else{
	$_SESSION['autenticador'] = 'NAO';
	header('Location: index.php?nome=erro');
}


?>