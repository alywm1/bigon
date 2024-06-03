<?php
// إعدادات الاتصال بقاعدة البيانات
$servername = "sql304.infinityfree.com"; // استخدم اسم الخادم الصحيح الخاص بك
$username = "if0_36568750"; // استخدم اسم المستخدم الصحيح الخاص بك
$password = "pYp5vpE4t5QC"; // استخدم كلمة المرور الصحيحة
$dbname = "if0_36568750_mim"; // استخدم اسم قاعدة البيانات الصحيحة

// إنشاء الاتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
