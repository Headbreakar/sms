<?php
include 'confiq.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $struckOffId = intval($_POST['struck_off_id']);

    // Delete the struck-off record
    $deleteQuery = "DELETE FROM struck_off_students WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $struckOffId);

    if ($stmt->execute()) {
        echo "<script>alert('Student reinstated successfully!'); window.location.href='struck_off.php';</script>";
    } else {
        echo "<script>alert('Error in reinstating student.'); window.location.href='struck_off.php';</script>";
    }
    $stmt->close();
}

$conn->close();
?>
