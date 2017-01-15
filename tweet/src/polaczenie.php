<?php

abstract class prototypPolaczenia {

    protected $ip = '127.0.0.1';
    protected $user = 'root';
    protected $password = 'coderslab';
    protected $database = '';

    /** @var mysqli|null */
    protected $conn = null;

    public function __construct($database = '') {
        $this->conn = mysqli_connect($this->ip, $this->user, $this->password, $this->database = $database);
        if ($this->conn->connect_error) {
            echo $this->conn->connect_error;
        }
    }

    function __destruct() {
        $this->conn->close();
    }

    public function getConn() {
        return $this->conn;
    }

    protected function boolQuery($sql) {
        if (!$this->conn->query($sql)) {
            echo $this->conn->error;
            return false;
        }
        return true;
    }

    public function createDatabaseIfNotExist($database = 'test') {
        $dbSelected = mysqli_select_db($this->conn, $database);
        if (!$dbSelected) {
            if (!$this->conn->query('CREATE DATABASE ' . $database)) {
                echo $this->conn->error;
                return false;
            } else {
                mysqli_select_db($this->conn, $database);
            }
        }
        return true;
    }

    public function createTableIfNotExist($tableName) {
        if (!$this->conn->query('DESCRIBE ' . $tableName)) {
            $sql = "CREATE TABLE $tableName (id int AUTO_INCREMENT, PRIMARY KEY(id))";
            return $this->boolQuery($sql);
        }
        return true;
    }

    public function deleteFromTable($tableName) {
        $sql = "DELETE FROM " . $tableName;
        return $this->boolQuery($sql);
    }

    public function addColumn($tableName, array $args) {
        $sql = "ALTER TABLE $tableName ADD " . implode(' ', $args);
        return $this->boolQuery($sql);
    }

    public function modifyColumn($tableName, array $args) {
        $sql = "ALTER TABLE $tableName MODIFY COLUMN " . implode(' ', $args);
        return $this->boolQuery($sql);
    }

    public function deleteColumn($tableName, $args) {
        $sql = "ALTER TABLE $tableName DROP COLUMN $args";
        return $this->boolQuery($sql);
    }

    public function deleteTable($name = 'test') {
        $sql = "DROP TABLE " . $name;
        return $this->boolQuery($sql);
    }

    public function deleteDatabase($name = 'test') {
        $sql = "DROP DATABASE " . $name;
        return $this->boolQuery($sql);
    }

    public function addForeignKey($fromTableName, $fromColumnName, $toTableName, $toColunmName) {
        $sql = "ALTER TABLE $fromTableName ADD CONSTRAINT FK_" . $fromTableName . "_" . $fromColumnName . "_" . $toTableName . "_" . $toColunmName . " FOREIGN KEY ($fromColumnName) REFERENCES $toTableName($toColunmName)";
        return $this->boolQuery($sql);
    }

    public function dropForeignKey($tableName,$foreignKeyName){
        $sql="alter table $tableName drop foreign key constraint $foreignKeyName";
        return $this->boolQuery($sql);
    }
    
}

class tweetDb extends prototypPolaczenia{}