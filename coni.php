<?php
try {
    // Assume $pdo is your PDO connection
    $pdo = new PDO('mysql:host=localhost;dbname=todo', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['do']) && !empty($_POST['do'])) {
        $stmt = $pdo->prepare("INSERT INTO list (do) VALUES (?)");
        $stmt->execute([$_POST["do"]]);
      
    } else {
        echo "Error: 'do' is not set or is empty";
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
header("Location:index.php");
?>