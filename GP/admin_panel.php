<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم - طلبات المطاعم</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Tahoma', sans-serif;
        }
        
        body {
            margin: 0;
            background: #f5f7fa;
            color: #333;
        }

        .sidebar {
            width: 250px;
            background: #2c3e50;
            height: 100vh;
            position: fixed;
            padding: 20px;
            color: white;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #34495e;
        }

        .container {
            margin-right: 250px;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .pending-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }

        .restaurant-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.2s;
        }

        .restaurant-card:hover {
            transform: translateY(-5px);
        }

        .card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-content {
            padding: 20px;
        }

        .rating {
            color: #f1c40f;
            margin: 10px 0;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            color: white;
            font-weight: bold;
            transition: opacity 0.3s;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .approve-btn {
            background: #27ae60;
        }

        .reject-btn {
            background: #e74c3c;
        }

        .empty-state {
            text-align: center;
            padding: 50px;
            background: white;
            border-radius: 12px;
            color: #7f8c8d;
        }

        .logout-btn {
            background: #e74c3c;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .fa-sign-out-alt {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>لوحة التحكم</h2>
        <a href="#"><i class="fas fa-home"></i> الرئيسية</a>
        <a href="#"><i class="fas fa-utensils"></i> المطاعم</a>
        <a href="#"><i class="fas fa-users"></i> المستخدمين</a>
        <a href="logout.php" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i>
            تسجيل الخروج
        </a>
    </div>

    <div class="container">
        <div class="header">
            <h1>الطلبات المعلقة 📋</h1>
        </div>

        <?php if ($result->num_rows > 0): ?>
            <div class="pending-grid">
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="restaurant-card">
                        <img src="<?= $row['image_path'] ?>" class="card-image" alt="صورة المطعم">
                        <div class="card-content">
                            <h3><?= htmlspecialchars($row['name']) ?></h3>
                            <div class="rating">
                                <?= str_repeat('★', $row['rating']) ?>
                            </div>
                            <p class="date"><?= $row['created_at'] ?></p>
                            
                            <form method="POST">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <div class="actions">
                                    <button type="submit" name="action" value="approved" class="btn approve-btn">
                                        <i class="fas fa-check"></i> موافقة
                                    </button>
                                    <button type="submit" name="action" value="rejected" class="btn reject-btn">
                                        <i class="fas fa-times"></i> رفض
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <img src="empty.svg" alt="لا توجد بيانات" width="150">
                <h2>لا توجد طلبات معلقة حالياً</h2>
                <p>سيظهر هنا أي طلبات جديدة يتم إرسالها من قبل المطاعم</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>