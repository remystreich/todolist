<div id="taskModal" class="modal text-black">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title text-black">Ajout de tâches journalières</h2>
            <button type="button" class="btn-close " onclick="closeTaskModal()"></button>
        </div>
        <div class="container mx-auto row">
            <form action="../controllers/dashboard.php" method="post" class="col-6 mx-auto ">
                <select class="form-select col-6 mb-5 mt-4 form-control-lg fw-bold fs-3" name="todoName" id="todo">
                    <option value="">Nouvelle tâche</option>
                    <?php
                    // récupération de la liste des taches par rapport au json
                    foreach ($task_filter as $task) {
                        echo '<option value="' . $task->name . '">' . $task->name . '</option>';
                    } ?>
                </select>
                
                    <?php
                    if ($_SESSION['status'] == 1) { // si l'utilisateur est l'admin, possibilité de choisir la team à qui attribuer la task
                        echo '<select name="selectTeam" id="selectTeam" class="form-select mt-4 mb-4">
                                    <option value="">Pour quelle équipe</option>';
                                    foreach ($team_filter as $team) {
                                        echo ' <option value="' . $team->id . '">' . $team->name . '</option>';
                                    }
                                       echo '</select>';
                    } ?>
                
                <div class="form-floating mb-3">
                    <input class="form-control" type="number" name="number" id="number" placeholder="Nombre">
                    <label for="number">Nombre de fois à effectuer</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" type="number" name="priorityOrder" id="priorityOrder" placeholder="ordre de priorité">
                    <label for="priorityOrder">Ordre de priorité</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" type="date" name="day" id="day">
                    <label for="day">Quel jour?</label>
                </div>
                <div class="text-center m-5">
                    <button type="submit" class="btn btn-dark">Envoyer</button>
                </div>
            </form>
        </div>

    </div>
</div>