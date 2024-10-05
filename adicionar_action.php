<?php
require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if ($name && $email) {

    if($usuarioDao->findByEmail($email) === false) {
        $novoUsuario = new Usuario();
        $novoUsuario->setNome($name);
        $novoUsuario->setEmail($email);

        $usuarioDao->add ( $novoUsuario );

        header("Location: index.php");
        exit;

    }else {
        header("Location: adicionar.php");
        exit;
    }

    /*
//buscando se tem o email digitado igual ja cadastrado
    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $sql->bindValue(':email', $email);
    $sql->execute();
//verificando se o usuário tem email cadastrado    
    if($sql->rowcount() === 0) {
        //montando o template $pdo->prepare use para manadar dados de forma segura para o banco de dados
        $sql = $pdo->prepare("INSERT INTO usuarios (nome, email) VALUES (:name, :email)");
        $sql->bindValue(':name', $name);
        $sql->bindValue(':email', $email);
        $sql->execute();
        //inserindo dados no banco de dados
        header("Location: index.php");
        exit;
    } else {
        header("Location: adicionar.php");
        exit;
    }*/
    
} else {
    header("Location: adicionar.php");
    exit;
}


/*require 'config.php';

// Sanitiza as entradas
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if ($name && $email) {
    try {
        // Monta o template da query
        $sql = $pdo->prepare("INSERT INTO usuarios (nome, email) VALUES (:name, :email)");
        $sql->bindValue(':name', $name);
        $sql->bindValue(':email', $email);
        
        // Executa a query
        $sql->execute();
        
        // Redireciona após o sucesso
        header("Location: index.php");
        exit;

    } catch (PDOException $e) {
        // Trate o erro (log, mensagem ao usuário, etc.)
        echo "Erro: " . $e->getMessage();
        exit;
    }

} else {
    // Redireciona se a validação falhar
    header("Location: adicionar.php");
    exit;
}
*/