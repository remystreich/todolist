<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/subscribe.css">
</head>

<body class="bg-dark text-white">
    <header>
        <h1 class="text-center p-3">TaskMaster</h1>
    </header>
    <main class="container-fluid ">
        <div class="container mx-auto text-center  col-5 my-container-form">
            <h2 class="m-4 ">Création d'un nouveau compte</h2>
            <form  action="../controllers/subscribe.php" method="post">
                <div class="row mt-5 gap-4 g-3">
                    <div class="row justify-content-center">
                        <div class="col-md-8 ">
                            <input class="form-control" type="text" name="userName" id="userName" placeholder="Nom d'utilisateur">
                        </div>

                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <input class="form-control" type="password" name="userPassword" id="userPassword" placeholder="Mot de passe">
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary">Envoyer</button>
                    </div>

                </div>
            </form>
            <div class="container-fluid mt-5">
                <p>Vous avez déjà un compte?</p>
                <a  href="./login.php">Login</a>
            </div>
        </div>
    </main>
    <script src="../assets/js/subscribe.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>

</html>

