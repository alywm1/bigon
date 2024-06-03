<?php
session_start();
include 'config.php';

$username = $_SESSION['username'];
$data = json_decode(file_get_contents('php://input'), true);
$points = $data['points'];

$stmt = $conn->prepare("UPDATE users SET points = ? WHERE username = ?");
$stmt->bind_param("is", $points, $username);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
