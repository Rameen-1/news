<?php
$message = "";
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        $name = basename($file['name']);
        $target = 'uploads/' . $name;
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
 
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
 
        if (in_array($ext, $allowed)) {
            if (move_uploaded_file($file['tmp_name'], $target)) {
                $message = "✅ Image uploaded successfully: <strong>$name</strong>";
            } else {
                $message = "❌ Failed to move the uploaded file.";
            }
        } else {
            $message = "❌ File type not allowed. Please upload JPG, PNG, GIF, or WEBP.";
        }
    } else {
        $message = "❌ No file selected.";
    }
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Upload Image – jpn.php</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { font-family: Arial; background: #f8f9fa; padding: 40px; }
        form {
            background: white; padding: 20px;
            max-width: 400px; margin: auto;
            border-radius: 10px; box-shadow: 0 0 10px #ccc;
        }
        input[type="file"] { margin-bottom: 15px; }
        button { padding: 10px 20px; background: #cc0000; color: white; border: none; border-radius: 5px; }
        .msg { text-align: center; margin-top: 20px; font-weight: bold; }
    </style>
</head>
<body>
 
<h2 style="text-align:center;">🖼️ Upload Image to /uploads</h2>
 
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="image" required accept="image/*">
    <button type="submit">Upload Image</button>
</form>
 
<?php if ($message): ?>
    <p class="msg"><?= $message ?></p>
<?php endif; ?>
 
</body>
</html>
 
