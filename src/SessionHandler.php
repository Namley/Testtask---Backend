<?php

namespace App;

use App\Repository\UserRepository;

class SessionHandler
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function setSessionUsername(string $username): void
    {
        $_SESSION['username'] = $username;
    }

    public function isLoggedIn(): bool
    {
        if (empty($_SESSION['username'])) {
            return false;
        }
        if ($this->userRepository->findOneByUsername($_SESSION['username']) === null) {
            unset($_SESSION['username']);
            return false;
        }
        return true;
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location:index.php');
    }

}