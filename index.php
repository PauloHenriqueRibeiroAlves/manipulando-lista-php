<?php
require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);
//para pegar todos da lista
$lista = $usuarioDao->findAll();

/*
$lista = [];
//para pegar os usuários no banco de dados
$sql = $pdo->query("SELECT * FROM usuarios");
if($sql -> rowCount() > 0) {
    $lista = $sql -> fetchAll(PDO::FETCH_ASSOC);
}*/

?>

<a href="adicionar.php">Adicionar usuário</a>

<table border="1" width="100%">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>email</th>
        <th>Ações</th>
    </tr>

    <?php foreach($lista as $usuario): ?>

        <tr>
            <td><?php echo $usuario->getId(); ?></td>
            <td><?php echo $usuario->getNome(); ?></td>
            <td><?php echo $usuario->getEmail(); ?></td>
            <td>
                <a href="editar.php?id=<?php echo $usuario->getId(); ?>">[ Editar ]</a>
                <a href="excluir.php?id=<?php echo $usuario->getId(); ?>" onclick="return confirm('Tem certeza que deseja excluir o usuário?')">[ Excluir ]</a>
            </td>
        </tr>

    <?php endforeach; ?>
    
</table>

