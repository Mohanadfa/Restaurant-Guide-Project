<?php
session_start();
include 'config.php';

// التحقق من صلاحيات المشرف
$is_admin = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

// معالجة طلب الحذف
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']) && $is_admin) {
    try {
        $id = (int)$_POST['id'];
        
        // 1. الحصول على معلومات المطعم
        $stmt = $conn->prepare("SELECT image_path FROM restaurants WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $image_path = $stmt->get_result()->fetch_assoc()['image_path'];
        
        // 2. حذف من قاعدة البيانات
        $stmt = $conn->prepare("DELETE FROM restaurants WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            // 3. حذف الصورة من السيرفر
            if (!empty($image_path) && file_exists($image_path)) {
                unlink($image_path);
            }
            $_SESSION['success'] = "تم حذف المطعم بنجاح";
        } else {
            $_SESSION['error'] = "خطأ في حذف المطعم";
        }
    } catch(Exception $e) {
        $_SESSION['error'] = "حدث خطأ: " . $e->getMessage();
    }
    header("Location: display.php");
    exit;
}

// استرجاع المطاعم المعتمدة
try {
    $stmt = $conn->prepare("SELECT * FROM restaurants WHERE status = 'approved' ORDER BY created_at DESC");
    $stmt->execute();
    $result = $stmt->get_result();
    $restaurants = $result->fetch_all(MYSQLI_ASSOC);
} catch(Exception $e) {
    die("خطأ في استرجاع البيانات: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض المطاعم</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url(imgs/RRB.jpg);
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .restaurant-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .restaurant-table th,
        .restaurant-table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .restaurant-table th {
            background-color: #4CAF50;
            color: white;
        }

        .restaurant-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .restaurant-table tr:hover {
            background-color: #f1f1f1;
        }

        .restaurant-image {
            max-width: 150px;
            max-height: 100px;
            border-radius: 5px;
            transition: transform 0.3s;
        }

        .restaurant-image:hover {
            transform: scale(1.5);
        }

        .rating-stars {
            color: #ffd700;
            font-size: 20px;
        }

        .delete-btn {
            background: #ff4444;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            border: none;
            transition: 0.3s;
        }

        .delete-btn:hover {
            background: #cc0000;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>قائمة المطاعم المسجلة</h1>
        
        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-error"><?= $_SESSION['error'] ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if(count($restaurants) > 0): ?>
            <table class="restaurant-table">
                <thead>
                    <tr>
                        <th>الإجراءات</th>
                        <th>اسم المطعم</th>
                        <th>الموقع</th>
                        <th>التقييم</th>
                        <th>الصورة</th>
                        <th>تاريخ التسجيل</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($restaurants as $restaurant): ?>
                    <tr>
                        <td>
                            <?php if($is_admin): ?>
                            <form method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا المطعم؟')">
                                <input type="hidden" name="id" value="<?= $restaurant['id'] ?>">
                                <button type="submit" name="delete" class="delete-btn">
                                    <i class="fa fa-trash"></i> حذف
                                </button>
                            </form>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($restaurant['name']) ?></td>
                        <td>
                            <a href="<?= htmlspecialchars($restaurant['map_url']) ?>" target="_blank">
                                عرض الموقع
                            </a>
                        </td>
                        <td>
                            <div class="rating-stars">
                                <?php 
                                $rating = (int)$restaurant['rating'];
                                echo str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);
                                ?>
                            </div>
                        </td>
                        <td>
                            <?php if(!empty($restaurant['image_path'])): ?>
                                <img src="<?= htmlspecialchars($restaurant['image_path']) ?>" 
                                     alt="صورة المطعم" 
                                     class="restaurant-image">
                            <?php else: ?>
                                <span>لا يوجد صورة</span>
                            <?php endif; ?>
                        </td>
                        <td><?= date('Y-m-d H:i', strtotime($restaurant['created_at'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align: center; color: #666;">لا توجد مطاعم مسجلة بعد</p>
        <?php endif; ?>

        <a href="view_home.php" style="display: block; text-align: center; margin-top: 20px; color: #4CAF50; text-decoration: none;">
            العودة إلى صفحة الرئيسية ←
        </a>
    </div>
</body>
</html>