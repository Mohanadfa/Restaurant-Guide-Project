<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // بيانات الدخول الثابتة (يجب تغييرها في البيئة الحية)
    $admin_user = 'admin';
    $admin_pass = 'admin123';

    if ($_POST['username'] === $admin_user && $_POST['password'] === $admin_pass) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin_panel.php');
        exit;
    } else {
        $error = 'بيانات الدخول غير صحيحة';
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل دخول المشرف</title>
    <link rel="stylesheet" href="lg.css">
</head>
<body>
    <div class="container">
        <form class="form" method="POST">
            <p class="title">Admin Login</p>
            <input name="username" placeholder="اسم المستخدم" class="username input" required>
            <input name="password" placeholder="كلمة المرور" class="password input" type="password" required>
            <button type="submit" class="btn">دخول</button>
            <?php if($error): ?>
                <p style="color: red;"><?= $error ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>