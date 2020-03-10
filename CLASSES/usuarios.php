<?php

class  Usuario
{
    private $pdo;
    public $msgErro = "";
    //variavel global qe comunica com os metodos

    //metodo conectar com tratament de excecoes
    public function conectar($nome, $host, $usuario, $senha)
	{
        global $pdo;
        global $msgErro;
		try 
		{
			$pdo = new PDO("mysql:dbname=".$nome,$usuario,$senha);
        
        } catch (PDOException $e) {
			$msgErro = $e->getMessage();
		}
	}

    //metodo cadastrar
    public function cadastrar($nome, $telefone, $email, $senha)
    {
        global $pdo;
        global $msgErro;
        //para cadastrar primeiro verificar se ja existe cadastro
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
        //selecione do bd na colune id_usuario, da tabela usuarios onde o email e = "e";
        $sql->bindValue (":e",$email);
        //substitui o parametro :e pelo paremetro do construtor email.
        //agora executa o comando
        $sql->execute();
        if($sql->rowCount() > 0)
        { // se o retorno da requisição for =1||>1 significa que existe usuario
            return false; //ja esta cadastrado
        }
        else
        { //caso não, efetuar cadastro
            $sql = $pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
            //efetua o cadastro
            $sql->bindValue (":n",$nome);
            //substitui o parametro :n pelo paremetro do construtor nome
            $sql->bindValue (":t",$telefone);
            //substitui o parametro :t pelo paremetro do construtor telefone
            $sql->bindValue (":e",($email));
            //substitui o parametro :e pelo paremetro do construtor email
            $sql->bindValue (":s",md5($senha));
            //substitui o parametro :e pelo paremetro do construtor senhaS

             //agora executa o comando
             $sql->execute();
             return true;
        }

    }

    //metodo logar
    public function logar($email, $senha)
    {
        global $pdo;

        //verificar se o email e senha já estao cadastrados
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s",md5($senha));
        $sql->execute();

        if($sql->rowCount() > 0)
        //verifica se existe cadastro feito
        {
             //se sim entrar na (sessao)
             $dado = $sql->fetch();
             // transformaa variavel $dado em array, e guarda todas as infos do DB;
             session_start();
             $_SESSION['id_usuario'] = $dado['id_usuario'];
             // o id do usuario fica guardado em uma sessao
             return true; //logado com sucesso

        }
        else
        {
            return false;// nao foi possivel logar
        }
       

    }


}



?>