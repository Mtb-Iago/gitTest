<?php

require_once 'CLASSES/usuarios.php';
$u = new Usuario();

?>

<html>
<html lang="pt-br">
    <head>
        <title>Projeto Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    <div id="corpo-form">
    <h1>Entrar</h1>   
            <form method="POST">
            <!--"POST" mais seguro linka com processamento--->
            <input type="email" name="email" placeholder="usuario" ><!--pega a info e compara-->
            <input type="password" name="senha" placeholder="senha" >
            <input type="submit" value="ACESSAR">
           <!--input botoes placehold requisição,value clik//LINKA PARA Acessar.php-->
           <!--linha 16 / linka o txt para end, strong NEGRITO--> 
           <a href="cadastrar.php"> Ainda não é inscrito?<strong>Cadastre-se!</strong></a>
            <!--linka para a pagina cadastrar-->
           
           
           <?php
              if (isset($_POST['email']))
              {
                  $email = addslashes($_POST['email']);//addslash proteção
                  $senha = addslashes($_POST['senha']);
                    if(!empty($email) && !empty($senha))
                     {
                        $u->conectar("projeto_login","localhost","root","");
                    //connectando com o banco,prencheu os parametros do metodo com infos do BD
                    if($u->$msgErro == "")
                    {

                        if($u->logar($email, $senha))
                        {
                            header("location: areaPrivada.php");
                        //encaminhar para a classe areaPrivada
                        }
                        else
                        {
                            ?>
                            <div class="msg-erro">
                            Email e/ou senha incorretos!
                            </div>
                            <?php
                        }

                    }
                    else 
                    {
                        echo "Erro ".$u->$msgErro;
                    }
                      }
                     else 
                     {
                        ?>
                        <div class="msg-erro">
                        Preencha todos os campos
                        </div>
                        <?php
                     }
              }

            ?>

        
        
        </form>
        </div>
    </body>
</html>