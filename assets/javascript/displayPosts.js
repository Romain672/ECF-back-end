/*let postsPerPage = 12;
let charactersMaximumDisplayedOnBody = 50;*/
let pageActuelle = 0;

document
  .querySelectorAll("footer button")[0]
  .addEventListener("click", clickPrecedent);
document
  .querySelectorAll("footer button")[1]
  .addEventListener("click", clickSuivant);

async function clickPrecedent(event) {
  pageActuelle--;
  displayPosts();
  if (pageActuelle == 0) {
    event.target.style.visibility = "hidden";
  }
  document.querySelectorAll("footer button")[1].style.visibility = "visible";
}
async function clickSuivant(event) {
  pageActuelle++;
  let message = await displayPosts();
  if (pageActuelle == 1) {
    document.querySelectorAll("footer button")[0].style.visibility = "visible";
  }

  //Cas particuliers
  if (message == "fin atteinte auparavant") {
    //Aucun résultat sur la page suivante => dernière page atteinte auparavant
    pageActuelle--;
    event.target.style.visibility = "hidden";
  }
  if (message == "fin atteinte") {
    //Résultats inférieur à ce qui a été demandé => dernière page
    event.target.style.visibility = "hidden";
  }
  //
}

displayPosts();

//Affichage
async function callApi(url) {
  const response = await fetch(url);
  const data = await response.json();
  return data;
}
async function displayPosts() {
  let result = await callApi(
    "/index.php/callApi?postsPerPage=" +
      postsPerPage +
      "&pageActuelle=" +
      pageActuelle
  );

  if (result.length > 0) {
    let main = document.querySelector("main");
    main.innerHTML = "";
    for (var line of result) {
      const newDiv = document.createElement("div");
      const newH1 = document.createElement("h1");
      newH1.innerHTML = majusculeMinuscules(line.title) + ":";
      newDiv.appendChild(newH1);
      const newH2 = document.createElement("h2");
      newH2.innerHTML = "#" + line.id;
      newDiv.appendChild(newH2);
      const newP = document.createElement("p");

      //gestion des ...
      let string = line.body;
      newP.innerHTML = line.body.substring(0, charactersMaximumDisplayedOnBody) + "..."; //si aucun espace dans le début du body
      for (let i = charactersMaximumDisplayedOnBody; i > 0; i--) {
        if (string[i] == " ") {
          newP.innerHTML = line.body.substring(0, i) + "...";
          break;
        }
      }
      if (newP.innerHTML == string) {
        newP.innerHTML =
          line.body.substring(0, charactersMaximumDisplayedOnBody) + "...";
      }
      if (string.length<charactersMaximumDisplayedOnBody){
        newP.innerHTML = line.body;
      }
      //

      newDiv.appendChild(newP);
      const newFooter = document.createElement("footer");
      newFooter.innerHTML =
        "Posted by " +
        majusculeMinuscules(line.username) +
        " the " +
        line.createdAt;
      newDiv.appendChild(newFooter);
      main.append(newDiv);

      const divBouton = document.createElement("div");
      newDiv.appendChild(divBouton);
      //Bouton voir plus
      if (window.location.pathname == "/accueil") {
        const newBouton = document.createElement("bouton");
        newBouton.identifiant = line.id;
        newBouton.innerHTML = "Voir plus";
        let offset = 0;
        newBouton.addEventListener("click", async function (event) {
          if (newBouton.innerHTML == "Voir plus"){
            newP.innerHTML = result.find(
            (element) => element.id == event.target.identifiant
            ).body;
            newBouton.innerHTML = "Afficher commentaires";
          } else {
            newBouton.innerHTML = "Afficher plus de commentaires";
            let id = newH2.innerHTML.replace("#","");
            let result = await callApi(
              "/index.php/afficherCommentaires?id="+ id + "&offset=" + offset
            );
            try {
              const newDivCommentaires = document.createElement("p");
              newDivCommentaires.innerHTML = result[0].body;
              divBouton.insertAdjacentElement("beforebegin", newDivCommentaires);
              const newDivCommentaires2 = document.createElement("p");
              newDivCommentaires2.innerHTML = result[1].body;
              divBouton.insertAdjacentElement("beforebegin", newDivCommentaires2);
            } catch {
              newBouton.style.visibility = "hidden";
            }
            offset = offset +2;
          }
        });
        divBouton.appendChild(newBouton);
      }

      //Bouton
      if (window.location.pathname == "/administration") {
        const newBouton = document.createElement("bouton");
        newBouton.identifiant = line.id;
        newBouton.innerHTML = "Modifier";
        newBouton.addEventListener("click", function (event) {
        newDiv.style.backgroundColor = "lightsalmon";

        const editDiv = document.createElement("div");
        editDiv.style.backgroundColor = "lightsalmon";

        try {
          editDiv.appendChild(document.querySelectorAll("body>form")[1]);
        } catch {
          let temp = document.querySelectorAll("body form")[1].parentNode;
          temp.querySelector("bouton").remove();
          editDiv.appendChild(document.querySelectorAll("body form")[1]);
          temp.remove();
        }
        //<button type="submit" name="submit" value="Valider">Valider</button>
        const newBoutonSubmitModify = document.createElement("bouton");
        newBoutonSubmitModify.type = "submit";
        newBoutonSubmitModify.name = "submit";
        newBoutonSubmitModify.value = "Valider";
        newBoutonSubmitModify.innerHTML = "Valider";
        editDiv.querySelector("#divbutton").insertAdjacentElement("beforeend", newBoutonSubmitModify);
        
        newBoutonSubmitModify.addEventListener("click", modifyPost);
        function modifyPost() {
          event.preventDefault();
          let newTitre = editDiv.children[0][0].value;
          let newContenu = editDiv.children[0][1].value;
          //let newAuteur = editDiv.children[0][2].value;
          let id=newH2.innerHTML.replace("#","");
          fetch("/index.php/modifyPost?title="+newTitre+"&body="+newContenu+"&id=" + id);
          document.querySelector("header").insertAdjacentHTML("afterend",
          "Element modifié avec succès, veuillez rafraichir la page."
          );

        }
          
        newDiv.insertAdjacentElement("afterend", editDiv);
        });
        divBouton.appendChild(newBouton);

        const newBouton2 = document.createElement("bouton");
        newBouton2.identifiant = line.id;
        newBouton2.innerHTML = "Supprimer";
        newBouton2.addEventListener("click", function () {
          //SWEETALERT
          swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this post",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          }).then((willDelete) => {
            if (willDelete) {
              newDiv.remove();
              fetch("index.php/deletePost", {
                method: "POST",
                body: `id=` + newBouton2.identifiant,
                headers: {
                  "Content-type": "application/x-www-form-urlencoded",
                },
              });
              swal("Poof! Your file has been deleted!", {
                icon: "success",
              });
            } else {
              swal("Your file is safe!");
            }
          });
        });
        divBouton.appendChild(newBouton2);
      }

      main.append(newDiv);
    }
  }

  if (result.length == 0) {
    return "fin atteinte auparavant";
  }
  if (result.length == postsPerPage) {
    return "nombre de résultats normaux";
  } else {
    return "fin atteinte";
  }
}

function majusculeMinuscules(string) {
  return string[0].toUpperCase() + string.substring(1).toLowerCase();
}
