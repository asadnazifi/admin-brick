<?php
$servername = "localhost"; // آدرس سرور دیتابیس
$username = "root"; // نام کاربری دیتابیس
$password = ""; // رمز عبور دیتابیس
$dbname = "Brick"; // نام دیتابیس

// اتصال به دیتابیس
$conn = mysqli_connect($servername, $username, $password, $dbname);

// بررسی اتصال
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

// این بخش را باید بسته‌اید mysqli_close($conn);
?>
