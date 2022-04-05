<?php

use App\AuthenticationHandler;
use App\DatabaseConnection;
use App\Repository\UserRepository;
use App\SessionHandler;

require_once 'vendor/autoload.php';

session_start();

$showError = false;

if (isset($_POST['submit'])) {
    $connect = new DatabaseConnection('root', '', 'news', 'localhost');
    $repository = new UserRepository($connect->getConnection());
    $auth = new AuthenticationHandler($repository);
    $sessionHandler = new SessionHandler($repository);
    $showError = !$auth->login($_POST['username'], $_POST['password']);

    if (!$showError) {
        $user = $repository->findOneByUsername($_POST['username']);
        $sessionHandler->setSessionUsername($user->getUsername());
        header('Location:news.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Backend</title>
    <script src="public/index.js"></script>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
<div class="center">
<img src="public/images/logo.svg" id="logo">

<?php if ($showError) { ?>
        <div class="alert">
            <strong>Wrong Login Data!</strong>
        </div>
    <?php } ?>

    <div class="loginForm">
        <form action="" method="post" >
            <div class="usernameLogin">
                <input type="text" id="username" name="username" class="username" placeholder="Username" required>
            </div>
            <div class="passwordLogin">
                <input type="password" name="password" id="password" class="password" placeholder="Password" required>
            </div>
            <button type="submit" class="submit" name="submit">Login</button>
        </form>
    </div>


</div>
</body>
</html>
