<?php include 'db.php'; $q = $_GET['q']; ?>
<!DOCTYPE html>
<html>
<head><title>Search: <?= htmlspecialchars($q) ?></title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="header"><h1>Search Results</h1></div>
<div class="container">
<a href="index.php">← Back</a><br><br>
<?php
$stmt = $conn->prepare("SELECT * FROM articles WHERE title LIKE ? OR content LIKE ?");
$search = "%$q%";
$stmt->execute([$search, $search]);
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
 
