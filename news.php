<?php
error_reporting(-1);
ini_set('display_errors', 'On');

use App\DatabaseConnection;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\UserRepository;
use App\SessionHandler;

require_once 'vendor/autoload.php';

session_start();

$connection = new DatabaseConnection('root', '', 'news', 'localhost');
$userRepository = new UserRepository($connection->getConnection());
$sessionHandler = new SessionHandler($userRepository);
$articleRepository = new ArticleRepository($connection->getConnection());

if (!$sessionHandler->isLoggedIn()) {
    header('Location:index.php');
}

$articles = $articleRepository->findAll();

if (isset($_POST['logout'])) {
    $sessionHandler->logout();
}

if (isset($_GET['delete'])) {
    $result = $articleRepository->deleteOneById($_GET['delete']);
    if (!$result) {
        header('Location:news.php?deleted=failure');
    }
    header('Location:news.php?deleted=success');
}

if (isset($_POST['create'])) {
    $article = new Article(null, $_POST['title'], $_POST['descriptions']);
    $result = $articleRepository->createArticle($article);
    if (!$result) {
        header('Location:news.php?created=failure');
    }
    header('Location:news.php?created=success');
}


if (isset($_POST['saveButton'])) {
    $result = $articleRepository->edit($_POST);
    if (!$result) {
        header('Location:news.php?edited=failure');
    } else {
        header('Location:news.php?edited=success');
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="public/index.js"></script>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
<div class="center">
    <img src="public/images/logo.svg" id="logo">

    <?php
    require_once 'banners.php';
    if (count($articles) > 0) {
        echo "<h2 class='all-news'>All News</h2>";
        foreach ($articles as $article) {
            ?>
            <div class="news-article-parent">
                <div class="article">
                    <strong id="<?php echo $article->getId(); ?> "
                            class="articleTitle"><?php echo $article->getTitle(); ?></strong>
                    <span id="<?php echo $article->getId(); ?>"
                          class="articleDescription"><?php if (strlen($article->getDescription()) > 30) {
                            echo substr($article->getDescription(), 0, 40) . "...";
                        } else echo $article->getDescription(); ?></span>
                </div>
                <div class="icon-box">
                    <a href="news.php?delete=<?php echo $article->getId(); ?>" id="deleteIconLink">
                        <img class="deleteIcon" src="public/images/close.svg" alt="">
                    </a>
                    <a href="#" data-id="<?php echo $article->getId(); ?>" class="editIconLink">
                        <img class="editIcon" src="public/images/pencil.svg" alt="">
                    </a>
                </div>
            </div>
        <?php }
    } ?>

    <strong class="create-news">Create News</strong>
    <strong class="edit-news">Edit News
        <div class="icon-box">
            <a href="" class="closeEditLink">
                <img class="closeEditIcon" src="public/images/close.svg" onclick="exitEdit()" alt="">
            </a>
        </div>
    </strong>
    <div class="form-parent-parent">
        <form method="post" name="createNews">
            <div class="form-parent">
                <div class="titleForm">
                    <input type="text" name="title" class="titleInput" placeholder="Title" required>

                    <textarea name="descriptions" class="descriptionInput" id="descriptionsInput"
                              placeholder="Desciprtions" cols="50" rows="15"></textarea>

                    <button type="submit" id="createButton" class="create" name="create">Create</button>
                </div>
        </form>
    </div>

    <form action="" method="post">
        <button type="submit" name="logout" class="logout">Logout</button>
    </form>

</div>
</body>
</html>

