<?php
function loginCheckAndRedirect($loginPage) {
    session_start();
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
        // کاربر لاگین کرده است، می‌توانید صفحه مورد نظر را نمایش دهید
        echo "Welcome to the member's area!";
    } else {
        // کاربر لاگین نکرده است، ریدایرکت به صفحه لاگین
        header("Location: $loginPage");
        exit;
    }
}

