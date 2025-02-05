<?php
class Usuario {
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private string $role = 'user';
    private string $createAt;

    private $pdo;
    private string $table = 'tablemanager';

    public function __construct($arg = NULL) {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=lr_clientes', 'root', '');
        } catch (PDOException $e) {
            var_dump('Error: '.$e->getMessage());
        }

        if(!empty($arg)) {
            $sql = "SELECT * FROM $this->table WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array($arg));

            if($stmt->rowCount() > 0) {
                $data = $stmt->fetch();
                $this->id = $data['id'];
                $this->name = $data['name'];
                $this->email = $data['email'];
                $this->password = $data['password'];
                $this->role = $data['role'];
                $this->createAt = $data['createAt'];
            }
        }
    }
    public function getId() {
        return $this->id;
    }
    
    public function setName($arg) {
        $this->name = $arg;
    }
    public function getName() {
        return $this->name;

    }
    
    public function setEmail($arg) {
        $this->email = $arg;

    }
    public function getEmail() {
        return $this->email;

    }

    public function setPassword($arg) {
        $this->password = md5($arg);

    }
    public function getPassword() {
        return $this->password;

    }

    public function setRole($arg) {
        $this->role = $arg;

    }
    public function getRole() {
        return $this->role;

    }
    public function getCreateAt() {
        return $this->createAt;

    }

    public function save() {
        if(!empty($this->id)) {
            $sql = "UPDATE $this->table SET name = ?, email = ?, role = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array(
                $this->name,
                $this->email,
                $this->role,
                $this->id
            ));
        } else {
            $sql = "INSERT INTO $this->table SET name = ?, email = ?, password = ?, role = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array(
                $this->name,
                $this->email,
                $this->password,
                $this->role
            ));

            if($stmt->rowCount() > 0) {
                echo 'Criado';
            } else {
                echo 'Não Criado';
            }
        }
    }

    public function delete() {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($this->id));

        if($stmt->rowCount() > 0) {
                echo 'Deletado';
            } else {
                echo 'Não Deletado';
            }
    }
}
?>