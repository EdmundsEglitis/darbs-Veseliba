<?php 
require_once "../App/Core/Database.php";

class Task {
    private $db;
    private $config;

    public function __construct() {
        $this->config = require("../App/config.php");
        $this->db = new Database($this->config);
    }
}
?>
