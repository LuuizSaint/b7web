<?php
namespace config;
use PDO;
use PDOException;

class User {
    private $dsn = 'mysql:host=localhost;dbname=lr_clientes';
    private $dbuser = 'root';
    private $dbpass = '';
    private $table = 'mailverify';

    public $conn;

    public function __construct() {
        try {
            $this->conn = new PDO($this->dsn, $this->dbuser, $this->dbpass);
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        } 

    }

    public function create($username, $useremail) {
        $token = bin2hex(random_bytes(16));

        $sql = "INSERT INTO $this->table SET username = ?, useremail = ?, token = ?";
        $stmt = $this->conn->prepare($sql);
        
        if($stmt->execute(array($username, $useremail, $token))) {
            sendMailVerify($useremail, $token);
            return true;
        }
    }
}
?>