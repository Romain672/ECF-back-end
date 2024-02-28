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
    print_r($_GET);

    $date = new DateTimeImmutable();
    $date = $date->format('c');
    
    $query = $pdo->prepare("UPDATE posts
    SET title = :title, body = :body, createdAt = :date
    WHERE id = :id
    ");
    //$query->bindValue('id', $_GET["id"], PDO::PARAM_STR);
    $query->bindValue('title', $_GET["title"], PDO::PARAM_STR);
    $query->bindValue('body', $_GET["body"], PDO::PARAM_STR);
    $query->bindValue('id', $_GET["id"], PDO::PARAM_STR);
    $query->bindValue('date', $date, PDO::PARAM_STR);
    $query->execute();

} catch (Exception $e) {
    echo "Query error:" . $e;
}