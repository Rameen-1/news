<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>DHL news</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header"><h1>📰 DHL News</h1></div>
 
<div class="container">
    <form action="search.php" method="GET">
        <input type="text" name="q" placeholder="Search news..." />
        <button type="submit">Search</button>
    </form>
 
    <div class="category-list">
        <a href="category.php?cat=World">World</a> |
        <a href="category.php?cat=Technology">Technology</a> |
        <a href="category.php?cat=Sports">Sports</a> |
        <a href="category.php?cat=Entertainment">Entertainment</a>
    </div>
 
    <?php
    $stmt = $conn->query("SELECT * FROM articles ORDER BY created_at DESC LIMIT 5");
    while ($row = $stmt->fetch()) {
        echo "<div class='article'>
            <h2><a href='article.php?id={$row['id']}'>{$row['title']}</a></h2>
            <img src='uploads/{$row['image']}' />
            <p>" . substr(strip_tags($row['content']), 0, 150) . "...</p>
            <small><em>Category: {$row['category']} | By {$row['author']} | {$row['created_at']}</em></small>
        </div>";
    }
    ?>
</div>
 
<div class="footer">© 2025 DHL news</div>
</body>
</html>
 
