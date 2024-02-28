<?php


//$postsPerPage = 12;
//$pageActuelle = 0;

//header('Location: ../pages/accueil.php');
//include "../pages/accueil.php";

$uri = $_SERVER['REQUEST_URI'];

/*
include "../../vendor/autoload.php";
$router = new AltoRouter();
$router->map('GET', '/', function () {
    echo "Bienvenue";
});
var_dump($router);
*/

if (!isset($_SESSION)){
    session_start();
}

if ($uri == "/administration") {
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == "admin") {
            include "../pages/administration.php";
        } else {
            include "../pages/connexion.php";
        }
    } else {
        include "../pages/connexion.php";
    }
}
if ($uri == "/accueil") {
    include "../pages/accueil.php";
}
if ($uri == "/connexion") {
    include "../pages/connexion.php";
}

if ($uri == "/deconnexion") {
    include "../assets/php/deconnexion.php";
}

if (preg_match("/\/index\.php\/callApi\?postsPerPage=([0-9]+)\&pageActuelle=([0-9]+)/", $uri)) {
    include "../assets/php/query/getPosts.php";
}
if($uri == "/index.php/deletePost"){
    include "../assets/php/query/deletePost.php";
}
if(preg_match("/\/index\.php\/addPost\?title=([0-9a-zA-Z]+)\&body=([0-9a-zA-Z]+)\&user=([0-9a-zA-Z]+)/", $uri)){
    include "../assets/php/query/addPost.php";
}
if(preg_match("/\/index\.php\/modifyPost\?title=([0-9a-zA-Z]+)\&body=([0-9a-zA-Z]+)\&id=([0-9a-zA-Z]+)/", $uri)){
    include "../assets/php/query/modifyPost.php";
}
if(preg_match("/\/index\.php\/afficherCommentaires\?id=([0-9a-zA-Z]+)\&offset=([0-9a-zA-Z]+)/", $uri)){
    include "../assets/php/query/afficherCommentaires.php";
}