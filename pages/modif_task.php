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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>

<body class="bg-dark text-white">
    <header>
        <h1 class="text-center p-3  mb-5">Taskmaster</h1>
    </header>
    <main class="container-fluid pt-5">
        <div class="container mx-auto text-center ">
            <h2 class="mb-5">Modification de la tâche</h2>
            <form action="../controllers/modif_task.php" method="post" class="text-dark">
                <div class="row gap-4 g-3">
                    <div class="mt-4">
                        <div class="form-floating  col-5 mx-auto">
                            <input class="form-control " type="text" name="modifTaskName" id="modifTaskName" placeholder="<?php echo $task_filter[0]->name; ?>">
                            <label for="modifTaskName">Ancien nom: <strong><?php echo $task_filter[0]->name; ?></strong></label>
                        </div>
                    </div>
                    <div>
                        <div class="form-floating col-5 mx-auto">
                            <input class="form-control  " type="number" name="modifDuration" id="modifDuration" placeholder="<?php echo $task_filter[0]->duration; ?>">
                            <label for="modifDuration">Ancienne durée : <?php echo $task_filter[0]->duration; ?> min</label>
                        </div>
                    </div>
                    <input type="hidden" name="name" value="<?php echo $task_filter[0]->name; ?>">
                    <div class="row justify-content-center mt-5">
                        <button class="btn btn-primary col-2 me-4 ">Valider</button>
                        <button class="btn btn-danger col-2"> <a class="text-decoration-none text-light" href="./dashboard.php">Annuler</a></button>
                    </div>
                </div>
            </form>
            <div class="container-fluid mt-5">
                <p>Modifiez uniquement les champs nécessaires</p>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>

</html>