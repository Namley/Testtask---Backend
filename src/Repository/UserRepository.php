<?php

namespace App\Repository;

use App\Entity\User;
use mysqli;
use mysqli_stmt;

class UserRepository
{
        private $connection;
    
        public function __construct(mysqli $connection)
        {
            $this->connection = $connection;
        }
    
        public function findOneByUsername(string $username): ?User
        {
            $stmt = $this->connection->prepare('SELECT * FROM users WHERE username = ?');
            $stmt->bind_param('s', $username);
    
            return $this->fetchAccount($stmt);
        }

        public function findOneById(int $id): ?User
    {
        $stmt = $this->connection->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->bind_param('i', $id);
        return $this->fetchAccount($stmt);
    }
    
        private function fetchAccount(mysqli_stmt $stmt): ?User
        {
            $id = null;
            $username = null;    
            $password = null;
        
            $stmt->bind_result(
                $id,
                $username,
                $password,
            );
    
            $stmt->execute();
    
            while ($stmt->fetch()) {
                $user = new User(
                    (int)$id,
                    $username,
                    $password,
                );
                return $user;
            }
            return null;
        }
    }