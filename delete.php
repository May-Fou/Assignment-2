<?php
include 'db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<h1>Success</h1>";
    } else {
        echo "<h1>Error</h1>";
    }

    $stmt->close();
    $conn->close();
}

header("Location: view.php");
exit();
?>