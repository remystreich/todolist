<?php
session_start();
//On verifie si la variable $_POST n'est pas vide
if(!empty($_POST)){
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
            $_SESSION["userId"] = $user_filter[0] -> id; 
            $_SESSION["userName"] = $user_filter[0] -> name;
            $_SESSION["status"] = $user_filter[0] -> status;
            $_SESSION["team"] = $user_filter[0] -> team;
            echo "logged in"; 
            usleep(200);
            header("Location: ../pages/dashboard.php"); //redirection vers le dashboard
        }
        else {
            echo "wrong password"; //si password incorrect
        }
    }else{
        echo "user not found"; //si user n'existe pas
    }
}
?>

