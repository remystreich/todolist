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

    if(!empty($user_filter)){
        if(password_verify($_POST['password'], $user_filter[0]->password)){
           
            $_SESSION["userId"] = $user_filter[0] -> id; 
            $_SESSION["userName"] = $user_filter[0] -> name;
            $_SESSION["status"] = $user_filter[0] -> status;
            $_SESSION["team"] = $user_filter[0] -> team;
            echo "logged in"; 
            header("Location: ../pages/dashboard.php");
        }
        else {
            echo "wrong password";
        }
    }else{
        echo "user not found";
    }
}
?>

