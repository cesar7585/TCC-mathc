<?php
class db {
    protected $pdo;

    public function __construct() {
        $host = 'localhost';
        $port = '3306';
        $dbname = 'codematch';
        $user = 'root';
        $password = '';

        try {
            
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);

            // Configurando atributos do PDO
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
        } catch (PDOException $e) {
            
          
            die("Erro ao conectar ao banco de dados.".$e->getmessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
?>
