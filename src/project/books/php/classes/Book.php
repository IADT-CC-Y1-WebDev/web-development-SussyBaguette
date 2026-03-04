<?php

class Book {
    public $id;
    public $title;
    public $release_date;
    public $publisher_id;
    public $description;
    public $image_filename;

    private $db;

    public function __construct($data = []) {
        $this->db = DB::getInstance()->getConnection();

        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->title = $data['title'] ?? null;
            $this->release_date = $data['release_date'] ?? null;
            $this->publisher_id = $data['publisher_id'] ?? null;
            $this->description = $data['description'] ?? null;
            $this->image_filename = $data['image_filename'] ?? null;
        }
    }

    // Find all books
    public static function findAll() {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM books ORDER BY title");
        $stmt->execute();

        $books = [];
        while ($row = $stmt->fetch()) {
            $books[] = new Book($row);
        }

        return $books;
    }

    // Find book by ID
    public static function findById($id) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM books WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        if ($row) {
            return new Book($row);
        }

        return null;
    }

    // Find books by publisher
    public static function findByPublisher($publisherId) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM books WHERE publisher_id = :publisher_id ORDER BY title");
        $stmt->execute(['publisher_id' => $publisherId]);

        $books = [];
        while ($row = $stmt->fetch()) {
            $books[] = new Book($row);
        }

        return $books;
    }

    // Find books by format (requires JOIN with BookFormats table)
    public static function findByFormat($formatId) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            SELECT g.*
            FROM books g
            INNER JOIN book_format gp ON g.id = gp.book_id
            WHERE gp.format_id = :format_id
            ORDER BY g.title
        ");
        $stmt->execute(['format_id' => $formatId]);

        $books = [];
        while ($row = $stmt->fetch()) {
            $books[] = new Book($row);
        }

        return $books;
    }

    // Save (insert or update)
    public function save() {
        if ($this->id) {
            // Update existing record
            $stmt = $this->db->prepare("
                UPDATE books
                SET title = :title,
                    release_date = :release_date,
                    publisher_id = :publisher_id,
                    description = :description,
                    image_filename = :image_filename
                WHERE id = :id
            ");

            $params = [
                'title' => $this->title,
                'release_date' => $this->release_date,
                'publisher_id' => $this->publisher_id,
                'description' => $this->description,
                'image_filename' => $this->image_filename,
                'id' => $this->id
            ];
        } 
        else {
            // Insert new record
            $stmt = $this->db->prepare("
                INSERT INTO books (title, release_date, publisher_id, description, image_filename)
                VALUES (:title, :release_date, :publisher_id, :description, :image_filename)
            ");

            $params = [
                'title' => $this->title,
                'release_date' => $this->release_date,
                'publisher_id' => $this->publisher_id,
                'description' => $this->description,
                'image_filename' => $this->image_filename
            ];
        }
        // Execute statement
        $status = $stmt->execute($params);

        // Check for errors
        if (!$status) {
            $error_info = $stmt->errorInfo();
            $message = sprintf(
                "SQLSTATE error code: %d; error message: %s",
                $error_info[0],
                $error_info[2]
            );
            throw new Exception($message);  
        }

        // Ensure one row affected
        if ($stmt->rowCount() !== 1) {
            throw new Exception("Failed to save book.");
        }

        // Set ID for new records
        if ($this->id === null) {
            $this->id = $this->db->lastInsertId();
        }
    }

    // Delete
    public function delete() {
        if (!$this->id) {
            return false;
        }

        $stmt = $this->db->prepare("DELETE FROM books WHERE id = :id");
        return $stmt->execute(['id' => $this->id]);
    }

    // Convert to array for JSON output
    public function toArray() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'release_date' => $this->release_date,
            'publisher_id' => $this->publisher_id,
            'description' => $this->description,
            'image_filename' => $this->image_filename
        ];
    }
}
