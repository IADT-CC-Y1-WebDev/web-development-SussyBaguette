<?php
class Publisher
{
    // public properties for each database column
    public $id;
    public $Name;
 
    // private $db property for database connection
    private $db;
 
    public function __construct($data = [])
    {
        $this->db = DB::getInstance()->getConnection();
 
        $this->id             = $data['id'] ?? null;
        $this->Name          = $data['Name'] ?? null;
    }
 
    public static function findAll()
    {
        $db = DB::getInstance()->getConnection();
 
        $stmt = $db->prepare("SELECT * FROM publishers ORDER BY Name");
        $stmt->execute();
 
        $publishers = [];
        while ($row = $stmt->fetch()) {
            $publishers[] = new Publisher($row);
        }
 
        return $publishers;
    }
 
    public static function findById($id)
    {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM publishers WHERE id = :id");
        $stmt->execute(['id' => $id]);
 
        $row = $stmt->fetch();
        if ($row) {
            return new Publisher($row);
        }
 
        return null;
    }
 
    public static function findByPublisher($publisherId)
    {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM publishers WHERE publisher_id = :publisher_id ORDER BY Name");
        $stmt->execute(['publisher_id' => $publisherId]);
 
        $publishers = [];
        while ($row = $stmt->fetch()) {
            $publishers[] = new Publisher($row);
        }
 
        return $publishers;
    }
 
    public function save()
    {
        // TODO: Implement this method
        if ($this->id) {
            $stmt = $this->db->prepare("
                UPDATE publishers
                SET Name = :Name
                WHERE id = :id
            ");
 
            $params = [
                'Name'          => $this->Name,
                'id'             => $this->id
            ];
        } else {
            $stmt = $this->db->prepare("
                INSERT INTO publishers (Name)
                VALUES (:Name)
            ");
 
            $params = [
                'Name'          => $this->Name,
            ];
        }
       
        $status = $stmt->execute($params);
 
        if (!$status) {
            $error_info = $stmt->errorInfo();
            $message = sprintf(
                "SQLSTATE error code: %s; error message: %s",
                $error_info[0],
                $error_info[2]
            );
            throw new Exception($message);
        }
 
        if ($stmt->rowCount() !== 1) {
            throw new Exception("Failed to save publisher.");
        }
 
        if ($this->id === null) {
            $this->id = $this->db->lastInsertId();
        }
    }
 
    public function delete()
    {
        if (!$this->id) {
            return false;
        }
 
        $stmt = $this->db->prepare("DELETE FROM publishers WHERE id = :id");
        return $stmt->execute(['id' => $this->id]);
    }
 
    public function toArray()
    {
        return [
            'id'             => $this->id,
            'Name'          => $this->Name,
        ];
    }
}
 