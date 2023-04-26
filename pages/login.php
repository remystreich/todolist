<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="../assets/css/subscribe.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body class="bg-dark text-white">
    <header>
        <h1 class="text-center p-3">TaskMaster </h1>
    </header>
    <main class="container-fluid">
        <div class="container mx-auto text-center my-container-form">
            <h2 class="mb-5">Login</h2>
            <form action="../controllers/login.php" method="post">
                <div class="row gap-4 g-3">
                    <div class="row justify-content-center">
                        <div class="col-md-4 ">
                            <input  class="form-control text" type="text" name="name" id="name" placeholder="Nom d'utilisateur">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4 ">
                            <input  class="form-control" type="password" name="password" id="password" placeholder="Mot de passe">
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary">Envoyer</button>
                    </div>
                </div>
            </form>
            <div class="container-fluid mt-5">
                <p>Vous n'avez pas de compte?</p>
                <a href="./subscribe.php">Créez en un</a>
            </div>

        </div>
    </main>
    <script src="../assets/js/login.js"></script>
</body>

</html>