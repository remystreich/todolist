<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../assets/css/subscribe.css">
</head>

<body>
    <header>
        <h1>TodoList</h1>
    </header>
    <main>
        <div>
            <h2>Création d'un nouveau compte</h2>
            <form action="../controllers/subscribe.php" method="post">
                <div>
                    <input type="text" name="userName" id="userName" placeholder="Nom d'utilisateur">
                    <input type="password" name="userPassword" id="userPassword" placeholder="Mot de passe">
                    <button>Envoyer</button>
                </div>
            </form>
            <div>
                <p>Vous avez déjà unpack compte?</p>
                <a href="./login.php">Login</a>
            </div>
        </div>
    </main>
    <script src="../assets/js/subscribe.js"></script>
</body>

</html>