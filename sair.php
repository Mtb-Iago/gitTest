<?php

session_start();
unset($_SESSION['id_usuario']);
header("location: index.php");
//encerra a sessao e desloga.


?>