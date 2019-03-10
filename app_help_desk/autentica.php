<?php
  //autenticador padrão.
  session_start();
  if(!isset($_SESSION['autenticador']) || $_SESSION['autenticador'] !== 'SIM'){
    header('Location: index.php?nome=erro2');  
} ?>