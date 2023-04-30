<?php
session_start();
$users = json_decode(file_get_contents('../json/user.json')); //récupérer et décoder sous forme de tableau le json des taches 
$user_filter = array_filter($users, function ($user) {
    return  $user->id == $_GET['userId'] && $user->companyId == $_SESSION['companyId'];
});
$user_filter = array_values($user_filter);

////récupérer les team de l'entreprise
$array_team = json_decode(file_get_contents('../json/team.json'));
$team_filter = array_filter($array_team, function ($team) {
    return $team->companyId == $_SESSION['companyId'];
});
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modif user</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>

<body class="bg-dark text-white">
    <header>
        <h1 class="text-center p-3  mb-5">Taskmaster</h1>
    </header>
    <main class="container-fluid pt-5">
        <div class="container mx-auto text-center">
            <h2 class="mb-5">Modification du collaborateur</h2>
            <form action="../controllers/modif_user.php" method="post" class="text-dark">
                <div class="row gap-4 g-3">
                    <div class="mt-4">
                        <div class="form-floating  col-5 mx-auto">
                            <input class="form-control " type="text" name="modifUserName" id="modifUserName" placeholder="<?php echo $user_filter[0]->name; ?>">
                            <label for="modifUserName">Ancien Nom : <?php echo $user_filter[0]->name; ?></label>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $user_filter[0]->id; ?>"> <!--Ancien nom envoyé en input caché -->
                    <?php 
                    if ($user_filter[0]->status != 1) {
                        echo ' <div class="col-5 mx-auto">
                        <select name="changeStatus" id="changeStatus" class="form-select col-5">
                            <option value="'. $user_filter[0]->status.'">Valeur précédante :'. $user_filter[0]->status.' </option>
                            <option value="0">Sous fifre</option>
                            <option value="1">Admin</option>
                            <option value="2">Chef</option>
                        </select>
                    </div>';
                    }
                    ?>
                    <div class="mt-4">
                        <div class="form-floating  col-5 mx-auto">
                            <input class="form-control" type="password" name="modifUserPassword" id="modifUserPassword">
                            <label for="modifUserPassword">Password</label>
                        </div>
                    </div>
                    
                    <div class="col-5 mx-auto">
                        <select class="form-select col-5" name="teamSelect" id="teamSelect">
                            <option value="<?php echo $user_filter[0]->team; ?>">Team précédente : <?php echo $user_filter[0]->teamName; ?></option>';
                            <?php
                            // liste des team qui s'incrémente à partir du json
                            $array_team = json_decode(file_get_contents('../json/team.json'));
                            foreach ($array_team as $team) {
                                echo '<option value="' . $team->id . '">' . $team->name . '</option>';
                            };
                            ?>
                        </select>
                    </div>
                    <div class="row justify-content-center mt-5">
                        <button class="btn btn-primary col-2 me-4 ">Valider</button>
                        <button class="btn btn-danger col-2"> <a class="text-decoration-none text-light" href="./dashboard.php">Annuler</a></button>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>

</html>