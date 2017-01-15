<?php

class messages{

    
    /** @var mysqli|null */
    public static $conn = null;
    
    private $id;
    private $content;
    private $userIdSender;
    private $userIdReciver;
    private $creationDate;

    function getCreationDate() {
        return $this->creationDate;
    }

    function setContent($content) {
        $this->content = $content;
    }

    function setUserIdSender($userIdSender) {
        $this->userIdSender = $userIdSender;
    }

    function setUserIdReciver($userIdReciver) {
        $this->userIdReciver = $userIdReciver;
    }

    function getId() {
        return $this->id;
    }

    function getContent() {
        return $this->content;
    }

    function getUserIdSender() {
        return $this->userIdSender;
    }

    function getUserIdReciver() {
        return $this->userIdReciver;
    }

    function __construct($content = '', $userIdSender = -1, $userIdReciver = -1) {
        $this->id = -1;
        $this->content = $content;
        $this->userIdSender = $userIdSender;
        $this->userIdReciver = $userIdReciver;
        $this->creationDate = date('Y-m-d H:i:s');
    }

    public function saveToDB() {
        if (self::$conn != null) {
            if ($this->id == -1) {
                $sql = "INSERT INTO messages (content, user_id_reciver, user_id_sender, creation_date) VALUES ('$this->content', '$this->userIdReciver', '$this->userIdSender','$this->creationDate')";
                $result = self::$conn->query($sql);
                if ($result == true) {
                    $this->id = self::$conn->insert_id;
                    return true;
                } else {
                    echo self::$conn->error;
                }
            } else {
                $sql = "UPDATE messages SET content = '$this->content' WHERE id = $this->id";
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

    static public function loadMessagesById($id) {

        $sql = "SELECT * FROM messages WHERE id=$id";
        $result = self::$conn->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $loadedMessages = new messages();
            $loadedMessages->id = $row['id'];
            $loadedMessages->content = $row['content'];
            $loadedMessages->userIdReciver = $row['user_id_reciver'];
            $loadedMessages->userIdSender = $row['user_id_sender'];
            $loadedMessages->creationDate = $row['creation_date'];
            return $loadedMessages;
        }



        return null;
    }

    static public function loadAllMessages() {
        $sql = "SELECT * FROM messages";
        $returnTable = [];
        if ($result = self::$conn->query($sql)) {
            foreach ($result as $row) {
                $loadedMessages = new messages();
                $loadedMessages->id = $row['id'];
                $loadedMessages->content = $row['content'];
                $loadedMessages->userIdReciver = $row['user_id_reciver'];
                $loadedMessages->userIdSender = $row['user_id_sender'];
                $loadedMessages->creationDate = $row['creation_date'];
                $returnTable[] = $loadedMessages;
            }
        }else{
            echo self::$conn->error;
        }

        return $returnTable;
    }

    static public function loadAllMessagesRelatedToUserId($id) {

        $sql = "SELECT * FROM messages WHERE user_id_reciver = $id or user_id_sender = $id order by creation_date desc";
        $returnTable = [];
        if ($result = self::$conn->query($sql)) {
            foreach ($result as $row) {
                $loadedMessages = new messages();
                $loadedMessages->id = $row['id'];
                $loadedMessages->content = $row['content'];
                $loadedMessages->userIdReciver = $row['user_id_reciver'];
                $loadedMessages->userIdSender = $row['user_id_sender'];
                $loadedMessages->creationDate = $row['creation_date'];
                $returnTable[] = $loadedMessages;
            }
        }else{
            echo self::$conn->error;
        }

        return $returnTable;
    }

    public function delete() {

        if ($this->id != -1) {

            if (self::$conn->query($sql = "DELETE FROM messages WHERE id=$this->id"))
                ; {
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }

}
