<?php
if (isset($_POST['login'])) {
    try {
        $pdo = new PDO("mysql:dbname=ECF;host=localhost;post=3306", "root", "", [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);
    } catch (PDOException $e) {
        print_r($e->getMessage());
    }
    try {
        $query = $pdo->prepare("SELECT * FROM user WHERE username='" . $_POST['login'] . "' AND password='" . $_POST['password'] . "'");
        $query->execute();
        $list = $query->fetchAll();
        //echo json_encode($list);
    } catch (Exception $e) {
        echo "Query error:" . $e;
    }
}
if (isset($list[0])) {
    //print_r("CONNECTE");
    $_SESSION['role'] = $list[0]->role;
    header("Location: /accueil");
} else {
    if (isset($list)) {
        //print_r("LOUPE");
        //print_r($list);
?>
        <script>
            alert("L'utilisateur ou le mot de passe n'est pas le bon.");
        </script>
<?php
    } else {
        //print_r("aucun try");
    }
}
