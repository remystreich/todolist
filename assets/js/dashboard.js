// Fonction pour ouvrir les modal
function openModal() {
  document.getElementById("myModal").style.display = "block";
}
function openTaskModal() {
  document.getElementById("taskModal").style.display = "block";
}

// Fonction pour fermer la modal
function closeModal() {
  document.getElementById("myModal").style.display = "none";
}
function closeTaskModal() {
  document.getElementById("taskModal").style.display = "none";
}

// Fermer la modal lorsque l'utilisateur clique en dehors de la modal
window.onclick = function (event) {
  if (event.target == document.getElementById("myModal")|| event.target == document.getElementById("taskModal")) {
    closeModal();
    closeTaskModal();
  }
}
///Gestion du contenu de la modal
let select = document.getElementById("select");
let team = document.getElementById('team');
let user = document.getElementById('user');
let task = document.getElementById('task');

///Quand la valeur du select est changée écoute sa valeur
select.addEventListener('change', (event) => {
  //si la valeur==team affiche le form correspondant
  if (select.value == "team") {
    user.style.display = "none";
    team.style.display = "block";
    task.style.display = "none";
  }
  //si la valeur==user affiche le form correspondant
  else if (select.value == "user") {
    user.style.display = "block";
    team.style.display = "none";
    task.style.display = "none";

  }
  //si la valeur==task affiche le form correspondant
  else if (select.value == "task") {
    console.log('bbscsec');
    task.style.display = "block";
    user.style.display = "none";
    team.style.display = "none";


  }
  //si aucune valeur n'est select aucun form est affiché
  else {
    user.style.display = "none";
    team.style.display = "none";
    task.style.display = "none";

  }
});


