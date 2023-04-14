<?php
    if (!empty($_POST)) {
        $user_name = $_POST['userName'];
        $user_password = password_hash($_POST['userPassword'], PASSWORD_DEFAULT);
        $user_id = uniqid();
        $new_user = ['id' =>$user_id, 'name'=>$user_name, 'password'=>$user_password, 'status'=>1];
        $array_user = json_decode(file_get_contents('../json/user.json')); //récupérer et décoder sous forme de tableau le json
        array_push($array_user, $new_user); //stocker les données du formulaire dans le tableau
        $array_user = json_encode($array_user); //réencoder le tableau
        file_put_contents("../json/user.json", $array_user); //renvoyer le tableau dans le json
        header("Location: ../pages/login.php"); //envoie sur la page de login
        die();
    }
    ?>