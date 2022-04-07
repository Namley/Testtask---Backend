<?php

namespace App\Repository;

use App\Entity\Article;
use mysqli_stmt;

class ArticleRepository
{
    private $connection;

    public function __construct(\mysqli $connection) {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $articles = [];
        $result = $this->connection->query('SELECT * FROM article');

        while ($row = $result->fetch_assoc()) {
            $articles[] = new Article(
                $row['id'],
                $row['title'],
                $row['description']);
        }

        return $articles;
    }

    public function createArticle(Article $article): bool // prepares an insert statement and bind it to create a single article
    {
        $stmt = $this->connection->prepare("INSERT INTO article(title,description) VALUES(?,?)");
        $title = $article->getTitle();
        $description = $article->getDescription();
        $stmt->bind_param('ss', $title, $description);

        return $stmt->execute();
    }

    public function deleteOneById(int $id):bool
    {
        $stmt = $this->connection->prepare('DELETE FROM article WHERE id = ?');
        $stmt->bind_param('i',$id);

        if (!$stmt->execute()) return false;
        $count = $stmt->affected_rows;
        $stmt->close();
        return ($count>0);
    }

    public function findOneById(int $id): ?Article
    {
        $stmt = $this->connection->prepare('SELECT * FROM article WHERE id = ?');
        $stmt->bind_param('i', $id);
        return $this->fetchArticle($stmt);
    }

    public function edit(array $article): bool // prepares an update statement to edit a news article. Afterwards it will check how many rows has been changed
    {
        $stmt = $this->connection->prepare('UPDATE article SET title = ?, description = ? WHERE id = ?');

        if (!$stmt) return false;

        $stmt->bind_param('ssi',
            $article['titleInput'],
            $article['descriptionInput'],
            $article['articleId']
        );

        if (!$stmt->execute()) return false;
        $count = $stmt->affected_rows;
        $stmt->close();
        return ($count > 0);

    }

    public function fetchArticle(mysqli_stmt $stmt):?Article //this is used to get an article objects from a select statement
    {
        $id = null;
        $title = null;
        $description = null;

        $stmt->bind_result(
            $id,
            $title,
            $description
        );

        $stmt->execute();

        while($stmt->fetch()) {
            $article = new Article(
                $id,
                $title,
                $description
            );
            return $article;
        }
        return null;
    }
}