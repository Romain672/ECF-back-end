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
    //$query = $pdo->query("SELECT * FROM posts LIMIT " . $_SESSION['postsPerPage'] . " OFFSET" . $_SESSION['postsPerPage'] . " * " . $_SESSION['pageAcutelle']);
    //$offset = $postsPerPage * $pageActuelle;

    $postsPerPage = $_GET["postsPerPage"];
    $pageActuelle = $_GET["pageActuelle"];
    $offset = $postsPerPage * $pageActuelle;

    $query = $pdo->prepare("SELECT posts.id, title, body, createdAt, username
    FROM posts
    INNER JOIN user ON posts.userId = user.id
    ORDER BY posts.id DESC
    LIMIT :var1 OFFSET :var2
    ");
    $query->bindValue('var1', $postsPerPage, PDO::PARAM_INT);
    $query->bindValue('var2', $offset, PDO::PARAM_INT);
    $query->execute();
    //$query = $pdo->query("SELECT * FROM posts LIMIT 8 OFFSET 2");
    $list = $query->fetchAll();
    echo json_encode($list);

} catch (Exception $e) {
    echo "Query error:" . $e;
}