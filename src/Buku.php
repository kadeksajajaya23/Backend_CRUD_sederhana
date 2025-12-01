<?php
class Buku {
    private $conn;
    private $table_name = "buku";

   
    public $id;
    public $judul;
    public $penulis;
    public $tahun_terbit;
    public $genre;
    public $cover;

    public function __construct($db) {
        $this->conn = $db;
    }
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->judul = $row['judul'];
            $this->penulis = $row['penulis'];
            $this->tahun_terbit = $row['tahun_terbit'];
            $this->genre = $row['genre'];
            $this->cover = $row['cover'];
            return true;
        }
        return false;
    }
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET judul=:judul, penulis=:penulis, tahun_terbit=:tahun, genre=:genre, cover=:cover";
        $stmt = $this->conn->prepare($query);
        
        $this->judul = htmlspecialchars(strip_tags($this->judul));
        $this->penulis = htmlspecialchars(strip_tags($this->penulis));
        $this->tahun_terbit = htmlspecialchars(strip_tags($this->tahun_terbit));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->cover = htmlspecialchars(strip_tags($this->cover));

        $stmt->bindParam(":judul", $this->judul);
        $stmt->bindParam(":penulis", $this->penulis);
        $stmt->bindParam(":tahun", $this->tahun_terbit);
        $stmt->bindParam(":genre", $this->genre);
        $stmt->bindParam(":cover", $this->cover);

        if ($stmt->execute()) { return true; }
        return false;
    }
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET judul=:judul, penulis=:penulis, tahun_terbit=:tahun, genre=:genre, cover=:cover WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $this->judul = htmlspecialchars(strip_tags($this->judul));
        $this->penulis = htmlspecialchars(strip_tags($this->penulis));
        $this->tahun_terbit = htmlspecialchars(strip_tags($this->tahun_terbit));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->cover = htmlspecialchars(strip_tags($this->cover));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":judul", $this->judul);
        $stmt->bindParam(":penulis", $this->penulis);
        $stmt->bindParam(":tahun", $this->tahun_terbit);
        $stmt->bindParam(":genre", $this->genre);
        $stmt->bindParam(":cover", $this->cover);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) { return true; }
        return false;
    }
}