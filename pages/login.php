<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
    <header>
        <h1>TodoList</h1>
    </header>
    <main>
        <div>
            <h2>Login</h2>
            <form action="../controllers/login.php" method="post">
                <div>
                    <input type="text" name="name" id="name" placeholder="Nom d'utilisateur">
                    <input type="password" name="password" id="password" placeholder="Mot de passe">
                    <button>Envoyer</button>
                </div>
            </form>
            <div>
                <p>Vous n'avez pas de compte?</p>
                <a href="./subscribe.php">Créez en un</a>
            </div>

        </div>
    </main>
    <script src="../assets/js/login.js"></script>
</body>

</html>