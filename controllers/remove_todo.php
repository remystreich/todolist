<?php
$array_todo = json_decode(file_get_contents('../json/todo.json')); //récupérer et décoder sous forme de tableau le json des taches journalieres
////récupérer la tache correspondant à l'élément à supprimer
foreach ($array_todo as $key => $task) {
    if ($task->todoName === $_GET['todoName']) {
      //suppression de la tache
      unset($array_todo[$key]);
      $array_todo = array_values($array_todo);
    }
  }
  $array_todo = json_encode($array_todo); //réencoder le tableau
  file_put_contents("../json/todo.json", $array_todo); //renvoyer le tableau dans le json
  header("Location: ../pages/dashboard.php");
  die;
?>