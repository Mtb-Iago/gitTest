<?php

session_start();
if(!isset($_SESSION['id_usuario']))
//se o usuario nao estiver logado, enta ele não pode entrar na sessao...
{
    header("location: index.php");
    exit;
}

?>

PARABÉNS VOCÊ ENTROU EM AREA RESTRITA   !!!!!
<a href="sair.php"> Sair</a>

