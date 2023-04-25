<?php
session_start();
$tasks = json_decode(file_get_contents('../json/task.json')); //récupérer et décoder sous forme de tableau le json des taches 
if (!empty($_POST)) {
    //trouver la tache correspondante par rapport à l'input caché
    foreach ($tasks as $task) {
        if ($task->name == $_POST['name']) {
            //remplacer par les nouvelles valeurs du form
            $task->name = $_POST['modifTaskName'];
            $task->duration = $_POST['modifDuration'];
            echo 'remcieuc';
        }
    }
    //réencodage du json et stockage
    $tasks = json_encode($tasks);
    file_put_contents('../json/task.json', $tasks);
}
header("Location: ../pages/dashboard.php");
die;
?>