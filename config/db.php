<?php
class db
{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    public function __construct()
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "root";
        $this->dbname = "enterpriseDB";

        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) die("Connection failed: " . $this->conn->connect_error);
    }

    public function getConn(){
        return $this->conn;
    }

    public function closeConn(){
        $this->conn->close();
    }
}
