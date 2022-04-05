<?php

namespace App\Entity;

class User
{
    private $id;
    private $username;
    private $password;

    public function __construct(
        ?int $id = null,
        ?string $username,
        ?string $password = null
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

}
