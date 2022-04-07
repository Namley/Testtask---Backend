<?php


use App\DatabaseConnection;
use App\Repository\ArticleRepository;

require_once 'vendor/autoload.php';

$connection = new DatabaseConnection('root', '', 'news', 'localhost');
$articleRepository = new ArticleRepository($connection->getConnection());
$article = $articleRepository->findOneById($_POST['id']);
?>

<form method="post" name="editNews">
    <div class="form-parent">
        <div class="titleForm">
            <input type="hidden" value="<?php echo $article->getId(); ?>" class="articleId" name="articleId">
            <input type="text" name="titleInput" value="<?php echo $article->getTitle(); ?>" class="titleInput" placeholder="Title" required>

            <textarea name="descriptionInput" class="descriptionInput" id="descriptionsInput" placeholder="Desciprtions" cols="50" rows="15"><?php echo $article->getDescription(); ?></textarea>

            <button type="submit" id="saveButton" class="saveButton" name="saveButton">Save</button>
        </div>
</form>