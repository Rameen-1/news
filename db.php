<?php
$host = "localhost";
$dbname = "dbhjbvdmw1zysj";
$username = "ux7oqwxcx8vsf";
$password = "v3hxvatbehaf";
 
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    die("DB connection failed: " . $e->getMessage());
}
?>
 
