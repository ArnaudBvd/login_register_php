<?php
require 'connect.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Email saisi
    // on vérifie si un email a été saisi
    if (empty($_POST['email'])) {
        $errors['email'] = 'Veuillez saisir un email !';
    }

    // Email valide
    // on vérifie si l'email n'est pas valide
    elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'L\'email n\'est pas valide';
    }

    // Email qui n'existe pas déjà
    $request = $pdo->prepare('SELECT * FROM user WHERE email = :email');
    $request->bindParam("email", $_POST["email"]);
    $request->execute();
    $res = $request->fetchAll();

    if (count($res) > 0) {
        $errors['email'] = 'Impossible, ce compte existe déjà';
    }

    // Password saisi
    
    // Password confirmé
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <h1 class="mb-5 text-center">Créer un compte</h1>

        <form action="" method="post" class="ms-5">
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" class="form-control
                
        <?php
        // Afficher les classes Bootstrap en fonction de la saisie
        // Bien se placer dans la classe
        if (array_key_exists("email", $errors)) {
            echo ('is-invalid');
        } else if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            echo ('is-valid');
        } ?>" type="text" name="email" placeholder="email">


                <?php
                // Afficher un message après l'input
                if (array_key_exists("email", $errors)) {
                    echo ('<div id="validationServerUsernameFeedback" class="invalid-feedback">
                ' . $errors['email'] . '
                </div>');
                } else if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                    echo ('<div class="valid-feedback">
                    Email valide !
            </div>');
                }
                ?>
            </div>


            <div class="form-group mt-3">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="Mot de passe" class="form-control">

                <label for="password2">Confirmation du mot de passe</label>
                <input type="password2" name="password2" id="password2" placeholder="Confirmez le mot de passe" class="form-control">
            </div>

            <input type="submit" class="btn btn-success my-4">
        </form>

        <a href="login.php">Me connecter</a>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </div>
</body>

</html>