<?php //form d'ajout de tache journaliere
session_start();
unset($_SESSION['day']);
    if (!empty($_POST['todoName']) && !empty($_POST['number']) && !empty($_POST['priorityOrder']) && !empty($_POST['day'])) { //verification que le form n'est pas vide
        $task = $_POST; //recuperation des valeurs du formulaire
        if($_SESSION['status'] != 1){
            $task['selectTeam']= $_SESSION['team'];
        };
        $tab_task = json_decode(file_get_contents('../json/task.json'));
        $tab_filter = array_filter($tab_task, function($data){
            return $data->name == $_POST['todoName'];
        });
        $tab_filter = array_values($tab_filter);
        $task['duration'] = $tab_filter[0]->duration;
        $task['companyId'] = $tab_filter[0]->companyId;
        $task['totalDuration']= $task['number'] * $task['duration'];
        $array_todo = json_decode(file_get_contents('../json/todo.json')); //récupérer et décoder sous forme de tableau le json des taches journalieres
        array_push($array_todo, $task); //stocker les données du formulaire dans le tableau
        $array_todo = json_encode($array_todo); //réencoder le tableau
        file_put_contents("../json/todo.json", $array_todo); //renvoyer le tableau dans le json
        header("Location: ../pages/dashboard.php"); 
        die();
    }
    
    ?>