<?php 
//logout simples onde destroi a session e redireciona o usuário para a index.php
session_start();
session_destroy();
header('Location: index.php')
 ?>