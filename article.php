<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);include 'db.php';
$id = $_GET['id'];
 
$stmt = $conn->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch();
?>
<!DOCTYPE html>
<html>
<head><title><?= $article['title'] ?></title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="header"><h1>CNN Clone</h1></div>
<div class="container">
    <a href="index.php">← Back</a>
    <h2><?= $article['title'] ?></h2>
    <img src="uploads/<?= $article['image'] ?>" />
    <p><?= nl2br($article['content']) ?></p>
    <small><em>By <?= $article['author'] ?> | <?= $article['created_at'] ?></em></small>
 
    <div class="comment-box">
        <h3>Comments</h3>
        <form method="POST">
            <input type="text" name="username" placeholder="Your name" required><br>
            <textarea name="comment" placeholder="Add a comment..." required></textarea><br>
            <button type="submit" name="submit">Comment</button>
        </form>
 
        <?php
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $comment = $_POST['comment'];
            $stmt = $conn->prepare("INSERT INTO comments (article_id, username, comment) VALUES (?, ?, ?)");
            $stmt->execute([$id, $username, $comment]);
        }
 
        $stmt = $conn->prepare("SELECT * FROM comments WHERE article_id = ? ORDER BY created_at DESC");
        $stmt->execute([$id]);
        while ($row = $stmt->fetch()) {
            echo "<p><strong>{$row['username']}:</strong> {$row['comment']} <em>({$row['created_at']})</em></p>";
        }
        ?>
    </div>
</div>
</body>
</html>
 
