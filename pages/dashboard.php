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
$todo_filter_admin = array_filter($array_todo, function ($todo) {
    return $todo->companyId == $_SESSION['companyId'] && $todo->day == $_SESSION['day'];
});
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/dashboard.css">

</head>

<body class="bg-dark text-white">
    <header>
        <h1 class="text-center p-3 mb-5">TaskMaster</h1>
    </header>
    <main class="container-fluid mx-auto">
        <div class="row text-center mx-auto">
            <div class="row col-lg-2 text-center mx-auto p-0">
                <div class=" bg-body-secondary  border border-black  container-fluid pb-3 rounded">
                    <h2 class="text-black p-2">Workspace</h2>
                    <form class="gap-2 row bg-secondary mx-auto p-2 rounded mt-5 mb-4" id="dateSelector" action="../controllers/date_select.php" method="get">
                        <input class="form-control" type="date" name="date" id="date">
                        <button class="btn btn-outline-light col-8 mx-auto">Choisir la date</button>
                    </form>
                    <div class="row justify-content-center mt-5">
                        <?php //affichage des fonctionnalités selon les status
                        if ($_SESSION['status'] > 0) { //disponible a l'admin et au chef
                            echo '<button class="btn btn-dark mb-4 mt-5 col-7" onclick="openTaskModal()">Ajout de tâches</button>';
                        }
                        if ($_SESSION['status'] == 1) { //disponible uniquement pour l'admin
                            echo '<button class="btn btn-dark mt-4 mb-5 col-7" onclick="openModal()">Créer élément</button>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-md-10">
               
                    <?php
                    if ($_SESSION['status'] == 1) { //disponible uniquement pour l'admin
                       echo' <div class="bg-body-secondary p-2 rounded border border-black row myBar mb-4">';
                        include('./menu_admin.php');
                        echo '</div>';
                    }
                    ?>
                

                <div>
                    <?php
                    if ($_SESSION['status'] == 1) {
                        include('./modal_admin.php');
                    }
                    if ($_SESSION['status'] > 0) {
                        include('./modal_addtask.php');
                    }
                    ?>
                </div>
                <div class="row">
                    <?php
                    if (isset($_SESSION['log']) ) {
                        echo '<div class="alert alert-danger border-3 border-danger alert-dismissible fade show col-6 mx-auto" role="alert">
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      <p class="my-auto"><strong>Attention </strong>'; echo $_SESSION['log']; echo'</p>
                    </div>';
                    };
                    sleep(1);
                    unset($_SESSION['log']);
                    ?>
                    <?php
                    //affichage des taches journalieres
                    echo '<div class="container-fluid mt-3 mt-md-0">';
                    foreach ($todo_filter as $todo) {
                        echo '<div class="todoCard card mb-3 p-2 bg-info-subtle  ">
                                    <div class="row g-0">
                                        <div class="col-md-3">
                                            <h3>' . $todo->todoName . '</h3>
                                        </div>
                                        <div class="col-md-4 col-12 row align-self-center">
                                            <p class="col-8 mx-auto">Nombre de fois à effectuer:' . $todo->number . ' </p>
                                        </div>
                                        <div class="col-md-4 col-12 align-self-center">
                                            <p class="mx-auto" >Durée:' . $todo->totalDuration . ' </p>
                                        </div>
                                        <div class="col-md-1 align-self-center">';
                        if ($_SESSION['status'] > 0) { //disponible a l'admin et au chef
                            echo '<button type="button" class=" btn btn-primary "><a class="text-light" href="../controllers/remove_todo.php?todoName=' . $todo->todoName . '">Tâche terminée</a></button>';
                        };
                        echo '</div></div></div>';
                    };
                    echo '</div>';
                    if ($_SESSION['status'] == 1 && isset($_SESSION['day'])) {
                        foreach ($team_filter as $team){
                            echo '<div class="card m-3 p-2 bg-success-subtle col-4">
                                    <div class="row g-0">
                                        <div class="col-12">
                                            <h3>' . $team->name . '</h3>
                                        </div>';
                                        $todoList = [];
                                        for ($i=0; $i < count($todo_filter_admin) ; $i++) { 
                                            if ($todo_filter_admin[$i]->selectTeam == $team->id){
                                                array_push($todoList, $todo_filter_admin[$i]); 
                                            }
                                        }
                                        foreach ($todoList as $todo){
                                            echo '<div class="row">
                                            <div class="col-md-4">
                                                    <h5>' . $todo->todoName . '</h5>
                                                </div>
                                                <div class="col-md-4  align-self-center">
                                                    <p class="col-8">Nombre de fois à effectuer:' . $todo->number . ' </p>
                                                </div>
                                                <div class="col-md-4 align-self-center">
                                                    <p >Durée:' . $todo->totalDuration . ' </p>
                                                </div>
                                                </div>';
                                        }
                                        echo '

                                    </div>
                                 </div>';
                        }
                    }
                    //affichage des team de l'entreprise
                    echo '<div id="teamCard" class="container-fluid">';
                    if ($_SESSION['status'] == 1) {
                        foreach ($team_filter as $team) {
                            echo '<div class="teamCard card mb-3 p-2 bg-info-subtle">
                                        <div class="row g-0">
                                            <div class="col-md-6">
                                                <h3>' . $team->name . '</h3>
                                            </div>
                                            <div class="col-md-6">
                                            <button type="button" class="btn btn-primary"><a class="text-light" href="../controllers/take_team.php?teamId=' . $team->id . '">Voir tâches de la team</a></button>    
                                            <button type="button" class="btn btn-danger"><a class="text-light" href="../controllers/remove_team.php?teamId=' . $team->id . '">Effacer</a></button>
                                            </div>
                                        </div>
                                  </div>';
                        };
                    };
                    echo '</div><div id="userCard" class="container-fluid">';
                    //affichage des collaborateurs
                    if ($_SESSION['status'] == 1) {
                        foreach ($user_filter as $user) {
                            echo '<div class="userCard card mb-3 p-2 bg-info-subtle">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <h3>' . $user->name . '</h3>
                                            </div>
                                            <div class="col-md-2">
                                                <p>Statut:' . $user->status . ' </p>
                                            </div>
                                            <div class="col-md-2">
                                                <p>Team : ' . $user->teamName . ' </p>
                                            </div>
                                            <div class="col-md-4 gx-4 d-flex justify-content-around">
                                                <button type="button" class="btn btn-warning"><a class="text-black" href="./modif_user.php?userId=' . $user->id . '">Modifier</a></button>
                                                <button type="button" class="btn btn-danger"><a class="text-white" href="../controllers/remove_user.php?userId=' . $user->id . '">Effacer</a></button>
                                            </div>
                                        </div>
                                </div>';
                        };
                    };

                    echo '</div><div id="taskCard" class="container-fluid">';
                    //affichage des taches
                    if ($_SESSION['status'] == 1) {
                        foreach ($task_filter as $task) {
                            echo '<div class="taskCard card mb-3 p-2 bg-info-subtle ">
                                        <div class="row g-0">
                                            <div class="col-md-5">
                                                <h4>' . $task->name . '</h4>
                                            </div>
                                            <div class="col-md-3">
                                                <p>Durée: ' . $task->duration . ' min </p>
                                            </div>
                                            <div class="col-md-4 gx-4 d-flex justify-content-around">
                                                <button type="button" class="btn btn-warning"><a class="text-black" href="./modif_task.php?taskName=' . $task->name . '">Modifier</a></button>
                                                <button type="button" class="btn btn-danger"><a class="text-white" href="../controllers/remove_task.php?taskName=' . $task->name . '">Effacer</a></button>
                                            </div>
                                        </div>
                                 </div>';
                        };
                    };
                    ?>
                </div>
            </div>
        </div>
    </main>
    <script src="../assets/js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>

</html>