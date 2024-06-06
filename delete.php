<?php
$conn = new PDO("mysql:host=localhost;dbname=todo", "root", "");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $query = $conn->prepare("DELETE FROM list WHERE id = :id");
    $query->bindParam(':id', $id);
    $query->execute();

    header('Location: index.php');
    exit;
}
?>
