<?php
// اتصال به پایگاه داده

    include_once "../functions/contect-to-db.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE gmail = '$username' and password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // کاربر اعتبارسنجی شده است
        $row = mysqli_fetch_assoc($result);
        if ($row['role'] === 'admin') {
            // اگر کاربر ادمین است، ورود انجام می‌شود
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("Location: http://localhost/admin-brick");
        } else {
            // اگر کاربر معمولی است، ورود انجام می‌شود
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("Location: user_panel.php");
        }
    } else {
        // اگر اطلاعات وارد شده اشتباه است
        echo "نام‌کاربری یا رمزعبور اشتباه است.";
    }
    mysqli_close($conn);
}

?>
