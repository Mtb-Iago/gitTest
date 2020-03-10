<?php
	require_once 'CLASSES/usuarios.php';
	$u = new Usuario();
?>

<html lang="pt-br">
    <head>
        <title>Projeto Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    <div id="corpo-form-cad">
    <h1>Cadastrar</h1>   
            <form method="POST">
                <!--(FOI RETIRADO PARA BAIXO) action="processa.php">
            <!=--"POST" mais seguro linka com processamento--->
            <input type="Text" name="nome" placeholder="Nome Completo" maxlength="30">
            <input type="Text" name="telefone" placeholder="Telefone" maxlength="30">
            <input type="email" name="email" placeholder="email" maxlength="40"> <!---name="atributo"todo input tem que ter para colher a info---->
            <input type="password" name="senha" placeholder="senha" maxlength="15"><!---maxlength limita a quantidade de caracteres imposta no bd--->
            <input type="password" name="confSenha" placeholder="confirma Senha" maxlength="15">
            <input type="submit"  value="Cadastrar">
           <!--input botoes placehold requisição,value clik//LINKA PARA Acessar.php-->
           <!--linha 16 / linka o txt para end, strong NEGRITO--> 
             </form>
    </div>
         <?php 
         date_default_timezone_set('America/Sao_Paulo');
        //verificar se o usuario clicou no botao
        
                if (isset($_POST['nome']))
        {
            $nome = addslashes($_POST['nome']); // addslashes proteção 
            $telefone = addslashes($_POST['telefone']);
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            $confSenha = addslashes($_POST['confSenha']);
            //verificar se estar vazio
            if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confSenha))
            {
                 $u->conectar("projeto_login","localhost","root","");
                    //connectando com o banco,prencheu os parametros do metodo com infos do BD
                    if($u->$msgErro == "")
                // se esta vazia é pq nao deu erro
                    {
                   if($senha == $confSenha)// se senha=confSenha  entao cadastrar
                    {
                        if($u->cadastrar($nome,$telefone,$email,$senha))
                        {
                            ?>
                            <div id="msg-sucesso">
                            <a href="index.php">Cadastrado com sucesso aperte para <strong>Entrar!</strong></a>
                            <!---botao para voltar a tela de login--->
                            </div>
                            <?php
                        }
                        else
                        {
                            ?>
                            <div class="msg-erro">
                                Email ja cadastrado!
                            </div>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <div class="msg-erro">
                            Senha e confirmar senha não correspondem
                        </div>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <div class="msg-erro">
                        <?php echo "Erro: ".$u->msgErro;?>
                    </div>
                    <?php
                }
            }else
            {
                ?>
                <div class="msg-erro">
                    Preencha todos os campos!
                </div>
                <?php
            }
        }
        
        
        ?>
        </body>
        </html>