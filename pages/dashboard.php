<?php
session_start();
///récupérer les task crées par l'entreprise
$array_task = json_decode(file_get_contents('../json/task.json'));
$task_filter = array_filter($array_task, function($task){
    return $task->companyId == $_SESSION['companyId'];
});
////récupérer les team de l'entreprise
$array_team = json_decode(file_get_contents('../json/team.json'));
$team_filter = array_filter($array_team, function($team){
    return $team->companyId == $_SESSION['companyId'];
});
////récuperer la liste de collaborateurs
$array_user = json_decode(file_get_contents('../json/user.json'));
$user_filter = array_filter($array_user, function($user){
    return $user->companyId == $_SESSION['companyId'];
});

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
    <header>
        <h1>TodoList</h1>
    </header>
    <main>
        <div>
            <h2>Workspace</h2>
            <input type="date" name="date" id="date">
            <?php //affichage des fonctionnalités selon les status
            if ($_SESSION['status'] > 0) { //disponible a l'admin et au chef
                echo '<button  onclick="openTaskModal()">Ajout de tâches</button>';
            }
            if ($_SESSION['status'] == 1) { //disponible uniquement pour l'admin
                echo '<button  onclick="openModal()">Créer élément</button>';
            }
            ?>
        </div> 
        <div> 
            <!-- Formulaire de creation d'élément -->
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h2>Création d'un nouvel élément</h2>
                    <form action="../controllers/create_elem.php" method="post">
                        <label for="select"></label>
                        <select name="select" id="select">
                            <option value="">--Que voulez vous créer--</option>
                            <option value="team">Nouvelle équipe</option>
                            <option value="user">Nouvel utilisateur</option>
                            <option value="task">Nouvelle tâche</option>

                        </select>
                        <div id="user">
                            <label for="userName">Nom d'utilisateur</label>
                            <input type="text" name="userName" id="userName">
                            <label for="userPassword">Mot de passe</label>
                            <input type="password" name="userPassword" id="userPassword">
                            <label for="status">Contrôle des tâches ?</label>
                            <input type="checkbox" name="status" id="status">
                            <select name="teamSelect" id="teamSelect">
                                <option value="">--Dans quelle équipe?--</option>
                                <?php // liste des team qui s'incrémente à partir du json
                                $array_team = json_decode(file_get_contents('../json/team.json'));
                                foreach ($array_team as $team) {
                                    echo '<option value="' . $team->id . '">' . $team->name . '</option>';
                                }
                                ?>
                            </select>
                            <button>Envoyer</button>
                        </div>
                        <div id="team">
                            <label for="teamName">Nom d'équipe</label>
                            <input type="text" name="teamName" id="teamName">
                            <button>Envoyer</button>
                        </div>
                        <div id="task">
                            <label for="taskName">Nouvelle tâche</label>
                            <input type="text" name="taskName" id="taskName">
                            <label for="duration">Durée de la tâche</label>
                            <input type="number" name="duration" id="duration">
                            <button>Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Formulaire d'ajout de tache journaliere -->
            <div id="taskModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeTaskModal()">&times;</span>
                    <h2>Ajout de Tâches</h2>
                    <form action="../controllers/dashboard.php" method="post">
                        <select name="todoName" id="todo">
                            <option value="">--Nouvelle tâche--</option>
                            <?php // récupération de la liste des taches par rapport au json
                            foreach ($task_filter as $task) {
                                echo '<option value="' . $task->name . '">' . $task->name . '</option>';
                            }
                            ?>
                        </select>
                        <?php
                        if ($_SESSION['status'] == 1) { // si l'utilisateur est l'admin, possibilité de choisir la team à qui attribuer la task
                            echo '<select name="selectTeam" id="selectTeam">
                            <option value="">--Pour quelle équipe--</option>';
                            foreach ($team_filter as $team){
                                echo ' <option value="' . $team->id . '">' . $team->name . '</option>';
                            }
                            '</select>';
                        }
                        ?>
                        <label for="number">Nombre de fois à effectuer</label>
                        <input type="number" name="number" id="number" placeholder="Nombre">
                        <label for="priorityOrder">Ordre de priorité</label>
                        <input type="number" name="priorityOrder" id="priorityOrder">
                        <label for="day">Quel jour?</label>
                        <input type="date" name="day" id="day">
                        <button>Envoyer</button>
                    </form>
                </div>
            </div>
            <?php

            ?>
        </div>
    </main>
    <script src="../assets/js/dashboard.js"></script>
</body>

</html>
