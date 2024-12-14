<?php
class db {
    protected $pdo;

    public function __construct() {
        $servername = 'srv950.hstgr.io';
        $username = 'u895973460_tcc';
        $password = 'tcc-Cesar-Yasmin123';
        $dbname = 'u895973460_Match';

        try {
            // Establishing a PDO connection
            $this->pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Handle connection errors
            die("Connection failed: " . $e->getMessage());
        }
    }

    // A method to get the PDO instance
    public function getConnection() {

        return $this->pdo;
    }
}
?>
