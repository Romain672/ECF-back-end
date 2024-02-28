<a href="/accueil">Accueil</a>
<?php
if (isset($_SESSION['role'])) {
?>
    <a href="/deconnexion">Se déconnecter</a>
<?php
    if ($_SESSION['role'] =="admin") {
        ?>
        <a href="/administration">Administration</a>
        <?php
    }
} else {
?>
    <a href="/connexion">Se connecter</a>
<?php
}
?>