<?php
session_start();
include 'config.php';

$username = $_SESSION['username'];

$stmt = $conn->prepare("SELECT points FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

echo json_encode(['points' => $user['points']]);

$stmt->close();
$conn->close();
?>
