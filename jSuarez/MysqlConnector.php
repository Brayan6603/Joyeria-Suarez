<?php

class MysqlConnector {
    private $server;
    private $connUser;
    private $connPassword;
    private $connDb;
    private $port;
    private $connection;

    function __construct() {
        $this->server = "172.17.0.2";
        $this->connUser = "root";
        $this->connPassword = "root";
        $this->connDb = "joyeria_suarez";
        $this->port = 3306;
    }

    public function Connect() {
        $this->connection = mysqli_connect($this->server, $this->connUser, $this->connPassword, $this->connDb, $this->port);
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
       $this->connection->set_charset("utf8");
    }

    public function ExecuteQuery($query) {
        $result = mysqli_query($this->connection, $query);
        if (!$result) {
            echo "<br>Error executing query: " . mysqli_error($this->connection);
            return false;
        }
        return $result;
    }

    public function CloseConnection() {
        if ($this->connection) {
            mysqli_close($this->connection);
            $this->connection = null;
        }
    }

    public function getLastInsertId() {
        return mysqli_insert_id($this->connection);
    }

  
    public function backupDatabase($b) {
        $backupFile = $b;
        $command = "mysqldump --host=".$this->server." --user=".$this->connUser." --password=".$this->connPassword." ".$this->connDb." > ".$backupFile;
        system($command, $output);
        return file_exists($backupFile);
    }
}
?>
