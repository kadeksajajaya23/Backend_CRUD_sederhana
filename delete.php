<?php
include_once 'config/Database.php';
include_once 'src/Buku.php';

if(isset($_GET['id'])){
    $database = new Database();
    $db = $database->getConnection();
    $buku = new Buku($db);
    $buku->id = $_GET['id'];
    
    if($buku->delete()){
        header("Location: index.php");
    } else {
        echo "Gagal menghapus.";
    }
}
?>