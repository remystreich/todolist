<?php
$array_task = json_decode(file_get_contents('../json/task.json')); //récupérer et décoder sous forme de tableau le json des taches 
foreach ($array_task as $key => $task) {
    if ($task->name === $_GET['taskName']) {
      unset($array_task[$key]);
      $array_task = array_values($array_task);
    }
  }
  $array_task = json_encode($array_task); //réencoder le tableau
  file_put_contents("../json/task.json", $array_task); //renvoyer le tableau dans le json
  header("Location: ../pages/dashboard.php");
  die;
?>