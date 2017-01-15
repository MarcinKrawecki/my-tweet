<?php

class news {

    /** @var mysqli|null */
    public static $conn = null;
    
    private $id;
    private $content;
    private $userId;
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

    function getId() {
        return $this->id;
    }

    function getContent() {
        return $this->content;
    }

    function getUserId() {
        return $this->userId;
    }

    function __construct($content='', $userId = -1) {
        $this->id = -1;
        $this->content = $content;
        $this->userId = $userId;
        $this->creationDate = date('Y-m-d H:i:s');
    }

    public function saveToDB() {
        if (self::$conn != null) {
            if ($this->id == -1) {
                $sql = "INSERT INTO news (content, user_id, creation_date) VALUES ('$this->content', $this->userId, '$this->creationDate')";
                $result = self::$conn->query($sql);
                if ($result == true) {
                    $this->id = self::$conn->insert_id;
                    return true;
                } else {
                    echo self::$conn->error;
                }
            } else {
                $sql = "UPDATE news SET content = '$this->content' WHERE id = $this->id";
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

    static public function loadNewsById($id) {

        $sql = "SELECT * FROM news WHERE id=$id";
        $result = self::$conn->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $loadedNews = new message();
            $loadedNews->id = $row['id'];
            $loadedNews->content = $row['content'];
            $loadedNews->userId = $row['user_id'];
            $loadedNews->creationDate = $row['creation_date'];
            return $loadedNews;
        }



        return $loadedMessage;
    }

    static public function loadAllNews() {
        $sql = "SELECT * FROM news order by creation_date desc";
        $returnTable = [];
        if ($result = self::$conn->query($sql)) {
            foreach ($result as $row) {
                $loadedNews = new news();
                $loadedNews->id = $row['id'];
                $loadedNews->content = $row['content'];
                $loadedNews->userId = $row['user_id'];
                $loadedNews->creationDate = $row['creation_date'];
                $returnTable[] = $loadedNews;
            }
        }

        return $returnTable;
    }

    public function delete() {

        if ($this->id != -1) {

            if (self::$conn->query($sql = "DELETE FROM news WHERE id=$this->id"))
                ;
            {
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }

}
