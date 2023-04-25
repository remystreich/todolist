<?php
session_start();
$tasks = json_decode(file_get_contents('../json/task.json')); //récupérer et décoder sous forme de tableau le json des taches 
if (!empty($_POST)) {
    echo $_POST['name'];
    // Step 4: Loop through the tasks array and find the matching task
    foreach ($tasks as $task) {
        echo $task->name;
        if ($task->name == $_POST['name']) {
            // Step 5: Update the properties of the task
            $task->name = $_POST['modifTaskName'];
            $task->duration = $_POST['modifDuration'];
            echo 'remcieuc';
        }
    }

    // Step 6: Encode the updated tasks array back into JSON format
    $updatedJsonData = json_encode($tasks);

    // Step 7: Save the updated JSON data back to its original location
    file_put_contents('../json/task.json', $updatedJsonData);
}
header("Location: ../pages/dashboard.php");
  die;
?>