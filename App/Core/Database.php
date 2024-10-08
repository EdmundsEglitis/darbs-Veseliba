<?php
class Database {
    public $dbconn;
    private $config;

    function __construct() 
    {
        $this->config = require "../app/config.php";

        // Build DSN string for MySQL connection
        $dsn = "mysql:host=" . $this->config['host'] . ";dbname=" . $this->config['dbname'];

        
        try {
            $this->dbconn = new PDO($dsn, $this->config['user'], $this->config['password']);
            $this->dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbconn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            
            die("Database connection failed: " . $e->getMessage());
        }
    }

  
    public function prepare($query) {
        return $this->dbconn->prepare($query);
    }

  
    public function execute($query, $params = []) {
        $stmt = $this->prepare($query);
        $stmt->execute($params);
        return $stmt; 
    }

    function __destruct() 
    {
        $this->dbconn = null;
    }
}
?>
