<?php
session_start();
$array_task = json_decode(file_get_contents('../json/task.json')); //récupérer et décoder sous forme de tableau le json des taches 
$task_filter = array_filter($array_task, function ($task) {
    return  $task->name == $_GET['taskName'] && $task->companyId == $_SESSION['companyId'];
});
$task_filter = array_values($task_filter);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modif tâche</title>
</head>

<body>
    <header>
        <h1>Modification de la tâche</h1>
    </header>
   <div>
        <h2>Modification de la tâche</h2>
        <form action="../controllers/modif_task.php" method="post">
            <label for="modifTaskName">Nom</label>
            <input type="text" name="modifTaskName" id="modifTaskName" placeholder="<?php echo $task_filter[0] ->name; ?>">
            <input type="hidden" name="name" value="<?php echo $task_filter[0] ->name; ?>'">
            <label for="modifDuration">Durée de la tâche</label>
            <input type="number" name="modifDuration" id="modifDuration" placeholder="<?php echo $task_filter[0] ->duration; ?>">
            <button>Valider</button>
            <button>Annuler</button>
        </form>
        </div>
    
</body>

</html>