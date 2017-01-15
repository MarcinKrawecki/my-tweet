<?php
class comments{

    /** @var mysqli|null */
    public static $conn = null;
    
    private $id;
    private $content;
    private $userId;
    private $newsId;
    private $creationDate;

    function getCreationDate() {
        return $this->creationDate;
    }

    function setContent($content) {
        $this->content = $content;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }

    function setNewsId($newsId) {
        $this->newsId = $newsId;
    }

    function getId() {
        return $this->id;
    }

    function getContent() {
        return $this->content;
    }

    function getUserId() {
        return $this->userId;
    }

    function getNewsId() {
        return $this->newsId;
    }

    function __construct($content, $userId, $newsId) {
        $this->id = -1;
        $this->content = $content;
        $this->userId = $userId;
        $this->newsId = $newsId;
        $this->creationDate = date('Y-m-d H:i:s');
    }

    public function saveToDB() {
        if (self::$conn != null) {
            if ($this->id == -1) {
                $sql = "INSERT INTO coments (content, user_id, news_id,creation_date) VALUES ('$this->content', '$this->userId', '$this->newsId', '$this->creationDate')";
                $result = self::$conn->query($sql);
                if ($result == true) {
                    $this->id = self::$conn->insert_id;
                    return true;
                } else {
                    echo self::$conn->error;
                }
            } else {
                $sql = "UPDATE coments SET content = '$this->content' WHERE id = $this->id";
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

    static public function loadComentsById($id) {

        $sql = "SELECT * FROM coments WHERE id=$id";
        $result = self::$conn->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $loadedMessage = new message();
            $loadedMessage->id = $row['id'];
            $loadedMessage->content = $row['content'];
            $loadedMessage->userId = $row['user_id'];
            $loadedMessage->newsId = $row['news_id'];
            $loadedMessage->creationDate = $row['creation_date'];
            return $loadedMessage;
        }



        return null;
    }

    static public function loadAllComents() {

        $sql = "SELECT * FROM coments";
        $returnTable = [];
        if ($result = self::$conn->query($sql)) {
            foreach ($result as $row) {
                $loadedMessages = new message();
                $loadedMessages->id = $row['id'];
                $loadedMessages->content = $row['content'];
                $loadedMessages->userId = $row['user_id'];
                $loadedMessages->newsId = $row['news_id'];
                $loadedMessages->creationDate = $row['creation_date'];
                $returnTable[] = $loadedMessages;
            }
        }

        return $returnTable;
    }

    static public function getAllComentsByNewsId($newsId) {

        $sql = "SELECT * FROM coments WHERE news_id = $newsId";
        $result = self::$conn->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $loadedMessage = new message();
            $loadedMessage->id = $row['id'];
            $loadedMessage->content = $row['content'];
            $loadedMessage->userId = $row['user_id'];
            $loadedMessage->newsId = $row['news_id'];
            $loadedMessage->creationDate = $row['creation_date'];
            return $loadedMessage;
        }
    }

    public function delete() {

        if ($this->id != -1) {

            if (self::$conn->query($sql = "DELETE FROM coments WHERE id=$this->id"))
                ; {
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }

}
