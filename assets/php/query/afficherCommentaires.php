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
    $id = $_GET["id"];
    $offset = $_GET["offset"];

    $query = $pdo->prepare("SELECT body
    FROM comments
    WHERE postId = :id
    ORDER BY id DESC
    LIMIT 2 OFFSET :var2
    ");
    $query->bindValue('id', $id, PDO::PARAM_INT);
    $query->bindValue('var2', $offset, PDO::PARAM_INT);
    $query->execute();
    $list = $query->fetchAll();
    echo json_encode($list);

} catch (Exception $e) {
    echo "Query error:" . $e;
}