<?php
session_start();
//On verifie si la variable $_POST n'est pas vide
if(!empty($_POST['password'])&& !empty($_POST['name'])){
    //On récupère le contenu du fichier JSON
    $array_user = json_decode(file_get_contents('../json/user.json'));
    //On filtre notre tableau d'utilisateurs par l'email du formulaire
    $user_filter = array_filter($array_user, function($user){
        return $user->name == $_POST['name'];
    });
    // On réordonne le tableau
    $user_filter = array_values($user_filter);
    // vérification de password
    if(!empty($user_filter)){
        if(password_verify($_POST['password'], $user_filter[0]->password)){ // si password correct
            $_SESSION["companyId"]= $user_filter[0]->companyId; //on récupere les valeurs des clés du json et on les stocke dans des variable de session
            $_SESSION["userId"] = $user_filter[0]->id; 
            $_SESSION["userName"] = $user_filter[0]->name;
            $_SESSION["status"] = $user_filter[0]->status;
            $_SESSION["team"] = $user_filter[0]->team;
            $_SESSION['log']='<p class="text-success">Connecté</p>';
            header("Location: ../pages/login.php"); //redirection vers le dashboard
        }
        else {
            //si password incorrect
            $_SESSION['log']= '<p class="text-danger">Mot de passe incorrect</p>';
            header("Location: ../pages/login.php");
        }
    }else{
        //si user n'existe pas
        $_SESSION['log']= '<p class="text-danger">Ce compte n\'existe past</p>';
        header("Location: ../pages/login.php");
    }
}else {
    $_SESSION['log']= '<p class="text-danger">Veuillez remplir tous les champs</p>';
        header("Location: ../pages/login.php");
}
?>

