<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        <?php
        include "../assets/style/style.css";
        ?>
    </style>
    <?php
    if(isset($_SESSION['role'])) {
        if($_SESSION['role']=="admin"){
            ?><style><?php
            include "../assets/style/styleAdmin.css";
            ?></style><?php
        } else {
            ?><style><?php
            include "../assets/style/styleUser.css";
            ?></style><?php
        }
    }
    ?>
    <title>Login</title>
</head>

<body>
    <header>
        <?php
        include "../assets/php/header.php";
        ?>
    </header>
    <aside>
        <span id="message"></span>
    </aside>
    <main>
        <form action="#" method="post">
            <div>
                <label for="login">Login:</label>
                <input type="text" name="login">
            </div>
            <div>
                <label for="password">Mot de passe:</label>
                <input type="password" name="password">
            </div>
            <button type="submit" id="submit" name="submit" value="Valider">Valider</button>
        </form>
        <?php
        include "../assets/php/query/seConnecter.php";
        ?>
    </main>
</body>

</html>