<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $action = $_POST['action'];
    
    $stmt = $conn->prepare("UPDATE restaurants SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $action, $id);
    $stmt->execute();
}

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
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url(imgs/RRB.jpg);
            margin: 0;
            padding: 0;
            direction: rtl;
        }
        .container {
            max-width: 900px;
            margin: auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .nav-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }
        .nav-links a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }
        .pending-item {
            background: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: transform 0.2s ease-in-out;
        }
        .pending-item:hover {
            transform: scale(1.01);
        }
        .pending-item h3 {
            margin-top: 0;
            color: #444;
        }
        .pending-item img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .pending-item p {
            margin: 10px 0;
            color: #555;
        }
        .actions {
            margin-top: 15px;
        }
        .actions button {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            margin-left: 10px;
            transition: background 0.3s ease;
        }
        .approve-btn {
            background-color: #28a745;
        }
        .approve-btn:hover {
            background-color: #218838;
        }
        .reject-btn {
            background-color: #dc3545;
        }
        .reject-btn:hover {
            background-color: #c82333;
        }
        @media (max-width: 600px) {
            .actions button {
                display: block;
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>الطلبات المعلقة</h1>
        <div class="nav-links">
            <a href="view_home.php">تسجيل الخروج</a>
            <a href="display.php">الطلبات المسجلة</a>
        </div>

        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="pending-item">
                    <h3><?= htmlspecialchars($row['name']) ?></h3>
                    <img src="<?= $row['image_path'] ?>" alt="صورة المطعم">
                    <p>التقييم: <?= str_repeat('★', $row['rating']) ?></p>
                    <p>التاريخ: <?= $row['created_at'] ?></p>
                    
                    <form method="POST" class="actions">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button type="submit" name="action" value="approved" class="approve-btn">موافقة</button>
                        <button type="submit" name="action" value="rejected" class="reject-btn">رفض</button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align: center; color: #999;">لا توجد طلبات معلقة حالياً</p>
        <?php endif; ?>
    </div>
</body>
</html>