<?php
session_start();
include 'config.php';

// تحقق من تسجيل الدخول
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit;
}

// معالجة الموافقة/الرفض
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $action = $_POST['action'];
    
    $stmt = $conn->prepare("UPDATE restaurants SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $action, $id);
    $stmt->execute();
}

// استرجاع الطلبات المعلقة
$stmt = $conn->prepare("SELECT * FROM restaurants WHERE status = 'pending'");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم - طلبات المطاعم</title>
    <style>
        /* إضافة نفس التنسيقات من display.php */
        .pending-item {
            border: 1px solid #ddd;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .actions button {
            margin: 5px;
            padding: 8px 15px;
        }
        .approve-btn { background: #4CAF50; }
        .reject-btn { background: #f44336; }
    </style>
</head>
<body>
    <div class="container">
        <h1>الطلبات المعلقة</h1>
        <a href="logout.php">تسجيل الخروج</a>
        
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="pending-item">
                    <h3><?= htmlspecialchars($row['name']) ?></h3>
                    <img src="<?= $row['image_path'] ?>" width="200">
                    <p>التقييم: <?= str_repeat('★', $row['rating']) ?></p>
                    <p>التاريخ: <?= $row['created_at'] ?></p>
                    
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button type="submit" name="action" value="approved" class="approve-btn">موافقة</button>
                        <button type="submit" name="action" value="rejected" class="reject-btn">رفض</button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>لا توجد طلبات معلقة حالياً</p>
        <?php endif; ?>
    </div>
</body>
</html>