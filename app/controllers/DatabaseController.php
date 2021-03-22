<?php
class DatabaseController
{
    protected $conn;
    protected $return;

    private $options  = array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  );

    public function openConnection()
    {
        require APP_ROOT . "settings.php";
        try {
            $this->conn = new PDO("mysql:host=$database->server;dbname=$database->database;charset=utf8", $database->user, $database->password, $this->options);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Connection failed:" . $e->getMessage();
        }
    }

    public function closeConnection()
    {
        $this->conn = null;
    }
}
