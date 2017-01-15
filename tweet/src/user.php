<?php

class user {
    /** @var mysqli|null */
    public static $conn = null;
    
    private $id;
    private $username;
    private $userPassword;
    private $email;

    function __construct($username='', $userPassword='', $email='') {
        $this->id = -1;
        $this->username = $username;
        $this->userPassword = md5($userPassword);
        $this->email = $email;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getUserPassword() {
        return $this->userPassword;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setUserPassword($userPassword) {
        $this->userPassword = md5($userPassword);
    }

    public function saveToDB() {
        if (self::$conn != null) {
            if ($this->id == -1) {
                $sql = "INSERT INTO users (user_name, user_email, user_password) VALUES ('$this->username', '$this->email', '$this->userPassword')";
                $result = self::$conn->query($sql);
                if ($result == true) {
                    $this->id = self::$conn->insert_id;
                    return true;
                } else {
                    echo self::$conn->error;
                }
            } else {
                $sql = "UPDATE users SET user_name = '$this->username', email = '$this->email', user_password = '$this->userPassword' WHERE id = $this->id";
                $result = self::$conn->query($sql);
                if ($result == true) {
                    return true;
                }
            }
        } else {
            echo "Brak połączenia <br>";
        }
        return false;
    }

    static public function loadUserById($id) {

        $sql = "SELECT * FROM users WHERE id=$id";
        $result = self::$conn->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $loadedUser = new user();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['user_name'];
            $loadedUser->userPassword = $row['user_password'];
            $loadedUser->email = $row['user_email'];
            return $loadedUser;
        }



        return null;
    }

    static public function loadUserByEmail($email) {

        $sql = "SELECT * FROM users WHERE user_email='$email'";
        $result = self::$conn->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $loadedUser = new user();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['user_name'];
            $loadedUser->userPassword = $row['user_password'];
            $loadedUser->email = $row['user_email'];
            return $loadedUser;
        }


        //tu jest nowy user ->funkcja niczego nie zwraca ale moze sie wykonac na pustym abiekcie//
        return new user();
    }
    
    static public function loadAllUsers() {

        $sql = "SELECT * FROM users";
        $returnTable = [];
        if ($result = self::$conn->query($sql)) {
            foreach ($result as $row) {
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['user_name'];
                $loadedUser->userPassword = $row['user_password'];
                $loadedUser->email = $row['user_email'];
                $returnTable[] = $loadedUser;
            }
        }

        return $returnTable;
    }

    public function delete() {

        if ($this->id != -1) {
            if (self::$conn->query($sql = "DELETE FROM users WHERE id=$this->id")){
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }

}
