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
}