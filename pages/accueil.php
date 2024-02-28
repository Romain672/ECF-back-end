<!--
bash:
$ php -S localhost:8080 -t public
-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        let postsPerPage = 12;
        let charactersMaximumDisplayedOnBody = 50;
    </script>

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
    <title>ECF MEESE Romain</title>
</head>
<body>
    <header>
        <?php
        include "../assets/php/header.php";
        ?>
    </header>
    <main>
        <?php
        //$result = include "../assets/php/getPosts.php";
        //Affichage sous forme <div><h1/><h2/><p/><footer/></div> de chaque post:
        ?>
    </main>
    <footer>
        <!--Pagination-->
        <button><== Précédent</button>
        <button>Suivant ==></button>
    </footer>


    
    <script>
        <?php
        include "../assets/javascript/displayPosts.js";
        ?>
    </script>
</body>
</html>