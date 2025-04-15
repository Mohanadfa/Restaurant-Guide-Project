<?php
// ملف display.php

// الاتصال بقاعدة البيانات
include 'config.php';

// استرجاع البيانات
$restaurants = [];
try {
    $stmt = $conn->prepare("SELECT * FROM restaurants ORDER BY created_at DESC");
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
            background-color: #f5f5f5;
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

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #4CAF50;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>قائمة المطاعم المسجلة</h1>
        
        <?php if(count($restaurants) > 0): ?>
            <table class="restaurant-table">
                <thead>
                    <tr>
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
                        <td><?php echo htmlspecialchars($restaurant['name']); ?></td>
                        <td>
                            <a href="<?php echo htmlspecialchars($restaurant['map_url']); ?>" target="_blank">
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
                                <img src="<?php echo htmlspecialchars($restaurant['image_path']); ?>" 
                                     alt="صورة المطعم" 
                                     class="restaurant-image">
                            <?php else: ?>
                                <span>لا يوجد صورة</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo date('Y-m-d H:i', strtotime($restaurant['created_at'])); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align: center; color: #666;">لا توجد مطاعم مسجلة بعد</p>
        <?php endif; ?>

        <a href="add.php" class="back-link">العودة إلى صفحة التسجيل ←</a>
    </div>
</body>
</html>