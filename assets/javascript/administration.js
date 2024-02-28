



document.querySelector("body>button").addEventListener("click", afficherFormAjouterPost);

function afficherFormAjouterPost() {
    document.querySelector("body>button").style.visibility = "hidden";
    document.querySelector("body>form").style.display = "block";

    document.querySelector("body>form>button").addEventListener("click", ajouterNewPost);
    async function ajouterNewPost(event) {
        event.preventDefault();

        let title = document.querySelector("body>form")[0].value;
        let contenu = document.querySelector("body>form")[1].value;
        //let auteur = document.querySelector("body>form")[2].value;
        fetch("/index.php/addPost?title="+title+"&body="+contenu+"&user=1");
        document.querySelector("header").insertAdjacentHTML("afterend",
        "Element ajouté avec succès, veuillez rafraichir la page."
        );
    }
}


