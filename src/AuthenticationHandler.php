<?php 

use App\Repository\UserRepository;

namespace App;

class AuthenticationHandler
{
    private $userRepository;

    public function __construct(Repository\UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function login(string $username, string $password):bool
    {
        if (empty($username) || empty($password)) {
            return false;
        }

        $user = $this->userRepository->findOneByUsername($username);

        if ($user === null) {
            return false;
        }

        return password_verify($password, $user->getPassword());
    }

}