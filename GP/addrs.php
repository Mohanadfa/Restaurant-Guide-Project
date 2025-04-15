<?php
$conn = null;
$error = '';
$success = '';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "redb";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $conn = new mysqli($servername, $username, $password, $dbname);
        
 
        if ($conn->connect_error) {
            throw new Exception("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
        }

        
        $name = $conn->real_escape_string($_POST['name'] ?? '');
        $map_url = $conn->real_escape_string($_POST['map'] ?? '');
        $rating = (int)($_POST['rating'] ?? 0);
        $image_path = '';


        if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $target_dir = "uploads/";
            $original_name = basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
            $new_filename = uniqid() . '.' . $imageFileType;
            $target_file = $target_dir . $new_filename;

            
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
            if(!in_array($imageFileType, $allowed_types)) {
                throw new Exception("الأنواع المسموحة: JPG, JPEG, PNG, GIF فقط");
            }
            if ($_FILES["image"]["size"] > 5000000000) {
                throw new Exception("حجم الصورة يجب أن يكون أقل من 500KB");
            }
            if(!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                throw new Exception("خطأ في رفع الملف");
            }
            
            $image_path = $target_file;
        } else {
            throw new Exception("يجب اختيار صورة صالحة");
        }

       
        $stmt = $conn->prepare("INSERT INTO restaurants (name, map_url, rating, image_path) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $name, $map_url, $rating, $image_path);
        
        if(!$stmt->execute()) {
            throw new Exception("خطأ في الحفظ: " . $stmt->error);
        }
        
        $success = "تم تسجيل المطعم بنجاح!";
        $stmt->close();

    } catch(Exception $e) {
        $error = $e->getMessage();
    } finally {
        if($conn) $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل مطعم !جديد</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url(imgs/RRB.jpg);
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
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

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #666;
            font-weight: bold;
        }

        input[type="text"],
        input[type="url"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .rating {
            display: flex;
            gap: 5px;
            direction: ltr;
        }

        .rating input {
            display: none;
        }

        .rating label {
            font-size: 30px;
            color: #ddd;
            cursor: pointer;
        }

        .rating input:checked ~ label,
        .rating label:hover,
        .rating label:hover ~ label {
            color: #ffd700;
        }

        .preview-image {
            width: 100%;
            max-width: 300px;
            margin-top: 10px;
            border-radius: 5px;
            display: none;
        }

        button {
            background: #4CAF50;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background 0.3s;
        }

        button:hover {
            background: #45a049;
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
        <h1>تسجيل مطعم جديد</h1>
        
        <?php if($error): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">اسم المطعم:</label>
                <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="map">رابط الموقع على خرائط جوجل:</label>
                <input type="url" id="map" name="map" required value="<?php echo htmlspecialchars($_POST['map'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label>التقييم:</label>
                <div class="rating">
                    <?php for($i=5; $i>=1; $i--): ?>
                        <input type="radio" id="star<?php echo $i; ?>" name="rating" value="<?php echo $i; ?>" 
                            <?php echo (isset($_POST['rating']) && $_POST['rating'] == $i) ? 'checked' : ''; ?> required>
                        <label for="star<?php echo $i; ?>">★</label>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="form-group">
                <label for="image">صورة المطعم:</label>
                <input type="file" id="image" name="image">
                
            </div>

            <button type="submit">تسجيل المطعم</button>
            <a href="view_home.php">الصفحة الرئيسية</a>
            
        </form>
    </div>

    <script>
        const imageInput = document.getElementById('image');
        const preview = document.getElementById('preview');

        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.style.display = 'block';
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>