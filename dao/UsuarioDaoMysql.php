<?php
//para não substituir a mesma classe use _once
    require_once 'models/Usuario.php';

    class UsuarioDaoMysql implements UsuarioDAO {
        private $pdo;

        public function __construct(PDO $driver) {
            $this -> pdo = $driver;
        }



        public function add(Usuario $u) {
            $sql = $this -> pdo -> prepare("INSERT INTO usuarios (nome, email) VALUES (:nome, :email)");
            $sql -> bindValue(':nome', $u -> getNome() );
            $sql -> bindValue(':email', $u -> getEmail() );
            $sql -> execute();

            $u -> setId( $this->pdo->lastInsertId() );
            return $u;
        }
        public function findAll() {
            $array = [];

            //fazendo a consulta no banco de dados
            $sql = $this->pdo->query("SELECT * FROM usuarios");
            if($sql->rowCount() > 0) {
                $data = $sql->fetchAll();

                foreach($data as $item) {
                    //variavél que vai conter os itens que o sistema for achando
                    $u = new Usuario();
                    //comando que vai criar a listagem dos itens que ele for achando
                    $u->setId($item['id']);
                    $u->setNome($item['nome']);
                    $u->setEmail($item['email']);

                    //comando que vai preencher o array da função principal
                    $array[] = $u;
                }
            }

            return $array;
        }
        public function findByEmail($email) {
            $sql = $this -> pdo -> prepare("SELECT * FROM usuarios WHERE email = :email");
            $sql -> bindValue(':email', $email);
            $sql->execute();

            if($sql -> rowCount() > 0) {
                $data = $sql -> fetch();

                $u = new Usuario();
                $u->setId($data['id']);
                $u->setNome($data['nome']);
                $u->setemail($data['email']);

                return $u;
            }else {
                return false;
            }
        }
        public function findById($id) {
            $sql = $this -> pdo -> prepare("SELECT * FROM usuarios WHERE id = :id");
            $sql -> bindValue(':id', $id);
            $sql->execute();

            if($sql -> rowCount() > 0) {
                $data = $sql -> fetch();

                $u = new Usuario();
                $u->setId($data['id']);
                $u->setNome($data['nome']);
                $u->setemail($data['email']);

                return $u;
            }else {
                return false;
            }
        }
        public function update(Usuario $u) {
            $sql = $this -> pdo -> prepare("UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id");
            $sql -> bindValue(':nome', $u -> getNome() );
            $sql -> bindValue(':email', $u -> getEmail() );
            $sql -> bindValue(':id', $u -> getId() );
            $sql -> execute();

            return true;
        }
        public function delete($id) {
            $sql = $this -> pdo -> prepare("DELETE FROM usuarios WHERE id = :id");
            $sql -> bindValue('id', $id);
            $sql -> execute();
        }
    }


?>