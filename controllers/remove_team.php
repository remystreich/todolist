<?php
$array_team = json_decode(file_get_contents('../json/team.json')); //récupérer et décoder sous forme de tableau le json des team
//récupérer la team correspondant à l'élément à supprimer
foreach ($array_team as $key => $team) {
    if ($team->id === $_GET['teamId']) {
      //suppression de la team
      unset($array_team[$key]);
      $array_team = array_values($array_team);
    }
  }
  $array_team = json_encode($array_team); //réencoder le tableau
  file_put_contents("../json/team.json", $array_team); //renvoyer le tableau dans le json
  header("Location: ../pages/dashboard.php");
  die;
?>