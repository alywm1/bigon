<?php
session_start();
include 'config.php'; // تأكد من تضمين ملف الاتصال بقاعدة البيانات

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // تحقق من صحة بيانات تسجيل الدخول
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        $_SESSION['points'] = $user['points'];
        header("Location: interface.html");
        exit();
    } else {
        echo "Invalid login credentials.";
    }
}
?>
