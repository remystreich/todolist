<?php
session_start();
///récupérer les task crées par l'entreprise
$array_task = json_decode(file_get_contents('../json/task.json'));
$task_filter = array_filter($array_task, function ($task) {
    return $task->companyId == $_SESSION['companyId'];
});
////récupérer les team de l'entreprise
$array_team = json_decode(file_get_contents('../json/team.json'));
$team_filter = array_filter($array_team, function ($team) {
    return $team->companyId == $_SESSION['companyId'];
});
////récuperer la liste de collaborateurs
$array_user = json_decode(file_get_contents('../json/user.json'));
$user_filter = array_filter($array_user, function ($user) {
    return $user->companyId == $_SESSION['companyId'];
});
////récupérer les taches de la team
$array_todo = json_decode(file_get_contents('../json/todo.json'));
$todo_filter = array_filter($array_todo, function ($todo) {
    return $todo->selectTeam == $_SESSION['team'] && $todo->day == $_SESSION['day'];
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
            <form id="dateSelector" action="../controllers/date_select.php" method="get">
                <input type="date" name="date" id="date">
                <button>Choisir la date</button>
            </form>
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
            <?php
            if ($_SESSION['status'] == 1) { //disponible uniquement pour l'admin
                echo '<div id="adminBar">
                <div></div>
                <div>
                    <div>
                        <button onclick="displayTeam()">Voir teams</button>
                    </div>
                    <div>
                        <button onclick="displayTask()">Voir tâches</button>
                    </div>
                    <div>
                        <button onclick="displayUser()">Voir utilisateurs</button>
                    </div>
                </div>
            </div>';
            }
            echo
            '<div>';
            if ($_SESSION['status'] == 1) {
                echo '<div id="myModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal()">&times;</span>
                        <h2>Création d\'un nouvel élément</h2>
                        <form action="../controllers/create_elem.php" method="post">
                            <label for="select"></label>
                            <select name="select" id="select">
                                <option value="">--Que voulez vous créer--</option>
                                <option value="team">Nouvelle équipe</option>
                                <option value="user">Nouvel utilisateur</option>
                                <option value="task">Nouvelle tâche</option>

                            </select>
                            <div id="user">
                                <label for="userName">Nom d\'utilisateur</label>
                                <input type="text" name="userName" id="userName">
                                <label for="userPassword">Mot de passe</label>
                                <input type="password" name="userPassword" id="userPassword">
                                <label for="status">Contrôle des tâches ?</label>
                                <input type="checkbox" name="status" id="status">
                                <select name="teamSelect" id="teamSelect">
                                    <option value="">--Dans quelle équipe?--</option>';
                // liste des team qui s'incrémente à partir du json
                $array_team = json_decode(file_get_contents('../json/team.json'));
                foreach ($array_team as $team) {
                    echo '<option value="' . $team->id . '">' . $team->name . '</option>';
                };

                echo '</select>
                                <button>Envoyer</button>
                            </div>
                            <div id="team">
                                <label for="teamName">Nom d\'équipe</label>
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
                </div>';
            }

            if ($_SESSION['status'] > 0) {
                echo '
                <div id="taskModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeTaskModal()">&times;</span>
                        <h2>Ajout de Tâches</h2>
                        <form action="../controllers/dashboard.php" method="post">
                            <select name="todoName" id="todo">
                                <option value="">--Nouvelle tâche--</option>';
                // récupération de la liste des taches par rapport au json
                foreach ($task_filter as $task) {
                    echo '<option value="' . $task->name . '">' . $task->name . '</option>';
                }
                echo
                '</select>';

                if ($_SESSION['status'] == 1) { // si l'utilisateur est l'admin, possibilité de choisir la team à qui attribuer la task
                    echo '<select name="selectTeam" id="selectTeam">
                            <option value="">--Pour quelle équipe--</option>';
                    foreach ($team_filter as $team) {
                        echo ' <option value="' . $team->id . '">' . $team->name . '</option>';
                    }
                    '</select>';
                };
                echo
                '<label for="number">Nombre de fois à effectuer</label>
                            <input type="number" name="number" id="number" placeholder="Nombre">
                            <label for="priorityOrder">Ordre de priorité</label>
                            <input type="number" name="priorityOrder" id="priorityOrder">
                            <label for="day">Quel jour?</label>
                            <input type="date" name="day" id="day">
                            <button>Envoyer</button>
                        </form>
                    </div>
                </div>';
            }
            echo '
            </div>'
            ?>
            <div >
                <?php
                //affichage des taches journalieres
                foreach ($todo_filter as $todo) {
                    echo '<div class="todoCard">
                            <h3>' . $todo->todoName . '</h3>
                            <p>Nombre de fois à effectuer:' . $todo->number . ' </p>
                            <p>Durée:' . $todo->totalDuration . ' </p>';
                    if ($_SESSION['status'] > 0) { //disponible a l'admin et au chef
                        echo '<a href="../controllers/remove_todo.php?todoName=' . $todo->todoName . '">Tâche terminée</a>';
                    }
                    '</div>
                        ';
                }

                //affichage des team de l'entreprise
                echo '<div id="teamCard">';
                if ($_SESSION['status'] == 1){
                    foreach ($team_filter as $team) {
                        echo '<div class="teamCard">
                        <h3>' . $team->name . '</h3>
                        <a href="../controllers/remove_team.php?teamId=' . $team->id . '">Effacer</a>
                        </div>';
                    };
                };
                echo '</div><div id="userCard">';
                //affichage des collaborateurs
                if ($_SESSION['status'] == 1){
                    foreach ($user_filter as $user) {
                        echo '<div class="userCard">
                        <h3>' . $user->name . '</h3>
                        <p>Statut:' . $user->status . ' </p>
                        <a href="../controllers/modif_user.php?userId=' . $user->id . '">Modifier</a>
                        <a href="../controllers/remove_user.php?userId=' . $user->id . '">Effacer</a>
                        </div>';
                    };
                };
                echo '</div><div id="taskCard">';
                //affichage des taches
                if ($_SESSION['status'] == 1){
                    foreach ($task_filter as $task) {
                        echo '<div class="taskCard">
                        <h3>' . $task->name . '</h3>
                        <p>Durée:' . $task->duration . ' </p>
                        <a href="../controllers/modif_task.php?taskName=' . $task->name . '">Modifier</a>
                        <a href="../controllers/remove_task.php?taskName=' . $task->name . '">Effacer</a>
                        </div>';
                    };
                };
                echo '</div>'
                ?>
            </div>
        </div>

    </main>
    <script src="../assets/js/dashboard.js"></script>
</body>

</html>