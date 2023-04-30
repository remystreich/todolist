<?php
session_start();
$users = json_decode(file_get_contents('../json/user.json')); //récupérer et décoder sous forme de tableau le json des taches 
if (!empty($_POST)) {
    //trouver l'utilisateur correspondant par rapport à l'input caché
    foreach ($users as $user) {
        if ($user->id == $_POST['id']) {
            //stockage des nouvelles valeurs
            if (!empty($_POST['modifUserName'])) {
                $user->name = $_POST['modifUserName'];
            }
            if (!empty($_POST['modifUserPassword'])) {
                $user->password = password_hash($_POST['modifUserPassword'], PASSWORD_DEFAULT);
            }
            $user->status = $_POST['changeStatus'];
            $user->team = $_POST['teamSelect'];
        }
    }
    $users = json_encode($users);
    file_put_contents('../json/user.json', $users);
}
header("Location: ../pages/dashboard.php");
die;
?>