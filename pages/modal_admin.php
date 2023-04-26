<div id="myModal" class="modal text-black">
    <div class="modal-content ">
        <div class="modal-header">
            <h2 class="modal-title text-black">Création d'un nouvel élément</h2>
            <button type="button" class="btn-close " onclick="closeModal()"></button>
        </div>
        <div class="container mx-auto row">
            <form action="../controllers/create_elem.php" method="post" class="col-6 mx-auto ">
                <select class="form-select col-6 mb-5 mt-4 form-control-lg fw-bold fs-3" name="select" id="select">
                    <option value="">--Que voulez vous créer--</option>
                    <option value="team">Nouvelle équipe</option>
                    <option value="user">Nouvel utilisateur</option>
                    <option value="task">Nouvelle tâche</option>

                </select>
                <div id="user">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="userName" id="userName" placeholder="Nom d'utilisateur">
                        <label for="userName">Nom d'utilisateur</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="password" name="userPassword" id="userPassword" placeholder="password">
                        <label for="userPassword">Mot de passe</label>
                    </div>
                    <select class="form-select mt-4 mb-4" name="teamSelect" id="teamSelect">
                        <option value="">--Dans quelle équipe?--</option>
                        <?php
                        foreach ($team_filter as $team) {
                            echo '<option value="' . $team->id . '">' . $team->name . '</option>';
                        }; ?>
                    </select>
                    <div class="form-check form-switch">
                        <label class="form-check-label" for="status">Contrôle des tâches ?</label>
                        <input class="form-check-input" type="checkbox" name="status" id="status">
                    </div>
                    <div class="text-center m-5">
                        <button type="submit" class="btn btn-dark">Envoyer</button>
                    </div>
                </div>
                <div id="team">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="teamName" id="teamName" placeholder="Nom d'équipe">
                        <label for="teamName">Nom d'équipe</label>
                    </div>
                    <div class="text-center m-5">
                        <button type="submit" class="btn btn-dark">Envoyer</button>
                    </div>
                </div>
                <div id="task">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="taskName" id="taskName" placeholder='Nom'>
                        <label for="taskName">Nom</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="number" name="duration" id="duration" placeholder="durée">
                        <label for="duration">Durée de la tâche</label>
                    </div>
                    <div class="text-center m-5">
                        <button type="submit" class="btn btn-dark">Envoyer</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>