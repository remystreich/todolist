<?php
$array_user = json_decode(file_get_contents('../json/user.json')); //récupérer et décoder sous forme de tableau le json des team
foreach ($array_user as $key => $user) {
    if ($user->id === $_GET['userId']) {
      unset($array_user[$key]);
      $array_user = array_values($array_user);
    }
  }
  $array_user = json_encode($array_user); //réencoder le tableau
  file_put_contents("../json/user.json", $array_user); //renvoyer le tableau dans le json
  header("Location: ../pages/dashboard.php");
  die;
?>