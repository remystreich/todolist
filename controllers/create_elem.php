<?php //formulaire de creation de team, utilisateur, taches
session_start();
unset($_SESSION['day']);
////récupérer les team de l'entreprise
$array_team = json_decode(file_get_contents('../json/team.json'));
$team_filter = array_filter($array_team, function ($team) {
    return $team->companyId == $_SESSION['companyId'];
});
//si le select est sur team
if ($_POST['select'] == "team") { 
    if (!empty($_POST['teamName'])) {
        $team_json = json_decode(file_get_contents('../json/team.json')); // décodage du json des team
        $team_filter = array_filter($team_json, function ($team) {
            return $team->name == $_POST['teamName'];
        });
        if ( empty($team_filter)) {
            $team_name = $_POST['teamName']; //nom de la team = valeur du form
        }else{
            $_SESSION['log']="cette team existe déjà";
            header("Location: ../pages/dashboard.php");
            die;
        }
        $team_id = uniqid(); //id du team
        $new_team = ['id' =>$team_id, "companyId"=>  $_SESSION["companyId"], 'name'=>$team_name]; //creation d'un tableau des valeurs de la team, 
        array_push($team_json, $new_team); //stockage de la nouvelle team dans le json
        $team_json = json_encode($team_json); //réencodage du json
        file_put_contents("../json/team.json", $team_json);
        header('location:../pages/dashboard.php');
        die;
    }else {
        $_SESSION['log']='Veuillez remplir tous les champs';
        header("Location: ../pages/dashboard.php"); 
        die; 
    }
};
//si le select est sur user
if ($_POST['select'] == "user") { 
    if (!empty($_POST['userName']) && !empty($_POST['userPassword']) && !empty($_POST['teamSelect'])){
        $user_json = json_decode(file_get_contents('../json/user.json')); //decodage du json des utilisateurs
        $user_filter = array_filter($user_json, function ($user) {
            return $user->name == $_POST['userName'];
        });
        if ( empty($user_filter)) {
            $user_name = $_POST['userName']; //nom de user = valeur du form
        }else{
            $_SESSION['log']='cet utilisateur existe déja';
            header("Location: ../pages/dashboard.php"); 
            die;
        }
        
        $user_password = password_hash($_POST['userPassword'], PASSWORD_DEFAULT); //hash la valeur du password
        $user_id = uniqid(); //id du user
        $user_team = $_POST['teamSelect']; //id de la team du user= valeur du form
        //récupération du nom de la team
        $teamName = "";
        foreach ($team_filter as  $team) {
            if ($team->id == $_POST['teamSelect']){
                $teamName = $team->name;
            };
        };
        $user_status = 0; //status de l'utilisateur = 0 (pas de privilege)
        if ($_POST['status'] == 'on') { // si la checkbox est cochée statut = 2 (peut agir sur les taches journalieres)
            $user_status = 2;
        }
        $new_user = ['id' =>$user_id, "companyId"=>  $_SESSION["companyId"], 'name'=>$user_name, 'password'=>$user_password, 'team'=>$user_team , 'status'=>$user_status, 'teamName'=>$teamName]; //creation d'un tableau avec les valeurs du user
        
        array_push($user_json, $new_user); //stockage du user dans le json
        $user_json = json_encode($user_json);
        file_put_contents("../json/user.json", $user_json);
        header('location:../pages/dashboard.php');
        die;

    }else {
        $_SESSION['log']='veuillez remplir tous les champs';
        header('location:../pages/dashboard.php');
        die;
    }
};
//si le select est sur task
if ($_POST['select'] == "task" ) { 
    if (!empty($_POST['taskName']) && !empty($_POST['duration'])){
    $task_json = json_decode(file_get_contents('../json/task.json'));
    $task_filter = array_filter($task_json, function ($task) {
        return $task->name == $_POST['taskName'];
    });
    if (empty($task_filter)) {
        $task_name = $_POST['taskName']; //nom de la task = valeur du form
    }else {
        $_SESSION['log']='cette tâche existe déjà';
        header('location:../pages/dashboard.php');
        die;
    }
    $task_duration = $_POST['duration']; //durée du task
    $new_task = ["companyId"=>  $_SESSION["companyId"],'name'=>$task_name, 'duration'=>$task_duration, 'priority'=>$task_priority , 'task_number'=>$task_number];
    array_push($task_json, $new_task);
    $task_json = json_encode($task_json);
    file_put_contents("../json/task.json", $task_json);
    header('location:../pages/dashboard.php');
    die;
}else {
    $_SESSION['log']='veuillez remplir tous les champs';
    header('location:../pages/dashboard.php');
    die;
}
};
