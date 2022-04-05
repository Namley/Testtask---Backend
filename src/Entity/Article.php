<?php 

namespace App\Entity;

class Article
{
    private $id;
    private $title;
    private $description;

    public function __construct(
        ?int $id = null,
        ?string $title = null,
        ?string$description = null
        ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }

    public function getId()
    {
        return $this->id;
    }

    
    public function getTitle()
    {
        return $this->title;
    }

    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
}