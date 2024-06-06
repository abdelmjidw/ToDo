<?php
$conn = new PDO("mysql:host=localhost;dbname=todo", "root", "");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $new_do = $_POST['new_do'];

    $query = $conn->prepare("UPDATE list SET do = :do WHERE id = :id");
    $query->bindParam(':id', $id);
    $query->bindParam(':do', $new_do);
    $query->execute();

    header('Location: index.php');
    exit;
}
?>
