<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password == $confirm_password) {
        // تشفير كلمة المرور
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // تحضير البيان
        $stmt = $conn->prepare("INSERT INTO users (username, password, points) VALUES (?, ?, ?)");
        
        // التحقق من نجاح التحضير
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        // ربط المعلمات بالقيم
        $initial_points = 0;
        if (!$stmt->bind_param("ssi", $new_username, $hashed_password, $initial_points)) {
            die('Bind param failed: ' . htmlspecialchars($stmt->error));
        }

        // تنفيذ البيان
        if ($stmt->execute()) {
            $_SESSION['username'] = $new_username;
            header("Location: interface.html");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Passwords do not match.";
    }
} else {
    header("Location: index.html");
    exit();
}

$conn->close();
?>
