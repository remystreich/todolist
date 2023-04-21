<?php //form d'ajout de tache journaliere
session_start();
    if (!empty($_POST)) { //verification que le form n'est pas vide
        $array_task = json_decode(file_get_contents('../json/task.json'));
        $task = $_POST; //recuperation des valeurs du formulaire
        if($_SESSION['status'] != 1){
            $task['selectTeam']= $_SESSION['team'];
        };
        $task_filter = array_filter($array_task, function($task){
            return $task->name == $_POST['todoName'];
        });
        $task['duration'] = $task_filter[0]->duration;
        $array_todo = json_decode(file_get_contents('../json/todo.json')); //récupérer et décoder sous forme de tableau le json des taches journalieres
        array_push($array_todo, $task); //stocker les données du formulaire dans le tableau
        $array_todo = json_encode($array_todo); //réencoder le tableau
        file_put_contents("../json/todo.json", $array_todo); //renvoyer le tableau dans le json
        header("Location: ../pages/dashboard.php"); 
        die();
    }
    ?>