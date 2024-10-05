<?php
$db_name = 'test';
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';

/*conectando no banco de dados */
//$pdo = new PDO ("mysql:dbname=test;host=localhost", "root", "");//ou 127.0.0.1
$pdo = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_pass);

//mostrando dados do banco de dados
/*$sql = $pdo->query('SELECT * from usuarios');

echo "Total: ".$sql->rowCount();

$dados = $sql->fetchall( PDO::FETCH_ASSOC );

echo '<pre>';
print_r($dados);*/