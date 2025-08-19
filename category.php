<?php include 'db.php'; $cat = $_GET['cat']; ?>
<!DOCTYPE html>
<html>
<head><title><?= htmlspecialchars($cat) ?> News</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="header"><h1><?= htmlspecialchars($cat) ?> News</h1></div>
<div class="container">
<a href="index.php">← Back to homepage</a><br><br>
<?php
$stmt = $conn->prepare("SELECT * FROM articles WHERE category = ?");
$stmt->execute([$cat]);
while ($row = $stmt->fetch()) {
    echo "<div class='article'>
        <h2><a href='article.php?id={$row['id']}'>{$row['title']}</a></h2>
        <img src='uploads/{$row['image']}' />
        <p>" . substr(strip_tags($row['content']), 0, 150) . "...</p>
    </div>";
}
?>
</div>
</body>
</html>
 
