<?php
class Author {
    private $conn;
    private $table = 'authors';

    public $id;
    public $author;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Read all authors
    public function read() {
        $query = "SELECT id, author FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read single author by ID
    public function read_single() {
        $query = "SELECT id, author FROM " . $this->table . " WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Set object properties
            $this->id = $row['id'];
            $this->author = $row['author'];
        }
    }


    // Create an author
    public function create() {
        $query = "INSERT INTO " . $this->table . " (author) VALUES (:author)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':author', $this->author);

        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // Update an author
    public function update() {
        $query = "UPDATE " . $this->table . " SET author = :author WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    // Delete an author
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public function exists() {
        $query = 'SELECT id FROM authors WHERE id = :id LIMIT 1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    
        return $stmt->rowCount() > 0; // Returns true if the author exists, otherwise false
    }


    public function exists2() {
        $query = "SELECT id FROM authors WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }
    
}
?>
