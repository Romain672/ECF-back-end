<?php
try {
    $pdo = new PDO("mysql:dbname=ECF;host=localhost;post=3306", "root", "", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]);
} catch (PDOException $e) {
    print_r($e->getMessage());
}
try {
    
    $query = $pdo->prepare("DELETE FROM posts
    WHERE id = :var1");
    $query->bindValue('var1', $_POST["id"], PDO::PARAM_INT);
    $query->execute();

} catch (Exception $e) {
    echo "Query error:" . $e;
}