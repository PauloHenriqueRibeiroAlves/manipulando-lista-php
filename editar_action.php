<?php
require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);

$id = filter_input(INPUT_POST, 'id');
$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if ($id && $name && $email) {
    $usuario = new Usuario();
    $usuario -> setId($id);
    $usuario -> setNome($name);
    $usuario -> setEmail($email);
    $usuarioDao -> update( $usuario );

    /*
    //comando que vai fazer a atualização direto no banco de dados
    $sql = $pdo->prepare("UPDATE usuarios SET nome = :name, email = :email WHERE id = :id");
    //função que vai substituir os dados antigos pelos novos
    $sql->bindValue(':name', $name);
    $sql->bindValue(':email', $email);
    $sql->bindValue(':id', $id);
    $sql->execute();*/

    header("Location: index.php");
    exit;

} else {
    header("Location: adicionar.php?id=".$id);
    exit;
}