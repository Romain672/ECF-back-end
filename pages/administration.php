<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        let postsPerPage = 200;
        let charactersMaximumDisplayedOnBody = 50;
    </script>
    <style>
        <?php
        include "../assets/style/style.css";
        include "../assets/style/stylePageAdmin.css";
        ?>
    </style>
    <?php
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == "admin") {
    ?><style>
                <?php
                include "../assets/style/styleAdmin.css";
                ?>
            </style><?php
                } else {
                    ?><style>
                <?php
                    include "../assets/style/styleUser.css";
                ?>
            </style><?php
                }
            }
                    ?>
    <title>Administration</title>
</head>

<body>
    <header>
        <?php
        include "../assets/php/header.php";
        ?>
    </header>

    <!--Form addPost-->
    <form action="#" method="post">
        <div>
            <label for="titre">Titre:</label>
            <input type="text" name="titre">
        </div>
        <div>
            <label for="contenu">Contenu:</label>
            <input type="text" name="contenu">
        </div>
        <div>
            <label for="auteur">Auteur:</label>
            <select name="auteur">
                <option value="admin">Jhon</option>
                <!--<option value="unknown">Unknown</option>-->
            </select>
        </div>
        <button type="submit" id="submit" name="submit" value="Valider">Valider</button>
    </form>

    <!--Form modify Post-->
    <form action="#" method="post">
        <div>
            <label for="titre">Titre:</label>
            <input type="text" name="titre">
        </div>
        <div>
            <label for="contenu">Contenu:</label>
            <input type="text" name="contenu">
        </div>
        <div>
            <label for="auteur">Auteur:</label>
            <select name="auteur">
                <option value="admin">Jhon</option>
                <!--<option value="unknown">Unknown</option>-->
            </select>
        </div>
        <div id="divbutton">
            <!--Ajouté en js: <button type="submit" name="submit" value="Valider">Valider</button>-->
        </div>
    </form>
    <button>
        <= Ajouter un post =>
    </button>





    <main>
    </main>
    <footer>
        <!--Pagination-->
        <button>
            <== Précédent</button>
                <button>Suivant ==></button>
    </footer>


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        <?php
        include "../assets/javascript/displayPosts.js";
        include "../assets/javascript/administration.js";
        ?>
    </script>
</body>

</html>