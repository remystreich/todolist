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
</head>

<body>
    <header>
        <h1>Modification du collaborateur</h1>
    </header>
    <div>

        <form action="../controllers/modif_user.php" method="post">
            <label for="modifUserName">Nom</label>
            <input type="text" name="modifUserName" id="modifUserName" placeholder="<?php echo $user_filter[0]->name; ?>">
            <input type="hidden" name="id" value="<?php echo $user_filter[0]->name; ?>"> <!--Ancien nom envoyé en input caché -->
            <select name="changeStatus" id="changeStatus">
                <option value="">--<?php echo $user_filter[0]->status; ?>--</option>
                <option value="">0</option>
                <option value="">1</option>
                <option value="">2</option>
            </select>
            <label for="modifUserPassword">Password</label>
            <input type="password" name="modifUserPassword" id="modifUserPassword">
            <select name="teamSelect" id="teamSelect">
                <option value="">--Dans quelle équipe?--</option>';
                <?php
                // liste des team qui s'incrémente à partir du json
                $array_team = json_decode(file_get_contents('../json/team.json'));
                foreach ($array_team as $team) {
                    echo '<option value="' . $team->id . '">' . $team->name . '</option>';
                };
                ?>
            </select>
            <button>Valider</button>
            <button>Annuler</button>
        </form>
    </div>

</body>

</html>