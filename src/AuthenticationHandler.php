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
    public function login(string $username, string $password):bool //check if user is in the database and if yes verify given password
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