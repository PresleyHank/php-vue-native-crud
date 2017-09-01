<?php

namespace Dao;

use Entity\User;
use Exception;
use PDO;
use PDOStatement;

class UserDaoImpl extends AbstractDaoImpl implements UserDao
{
    private const DB_TABLE = '`user`';

    private const SELECT_USER_BY_ID = 'SELECT * FROM  ' . self::DB_TABLE . ' WHERE `id`=:id;';
    private const SELECT_USER_BY_LOGIN_OR_EMAIL = '
    SELECT * FROM  ' . self::DB_TABLE . '
       WHERE ( `username` = :loginOrEmail OR `email` = :loginOrEmail) 
       AND `password` = :password;';
    private const IS_USERNAME_EXISTS = 'SELECT * FROM  ' . self::DB_TABLE . ' WHERE `username`=:username;';
    private const IS_EMAIL_EXISTS = 'SELECT * FROM  ' . self::DB_TABLE . ' WHERE `email`=:email;';

    private const INSERT_NEW_USER = 'INSERT INTO ' . self::DB_TABLE . '(`username`, `email`, `password`, `active`) 
      VALUES (:username, :email, :password, :active);';
    private const UPDATE_USER = 'UPDATE  ' . self::DB_TABLE . ' 
      SET `username`=:username, `email`=:email, `password`=:password, active=:active
      WHERE `id`=:id;';

    private const REMOVE_USER = 'DELETE FROM  ' . self::DB_TABLE . ' WHERE `id`=:id;';
    private const LIST_ALL_USERS = 'SELECT * FROM  ' . self::DB_TABLE . ';';

    public function get(int $id): ?User
    {
        try {
            $pdo = $this->connect();
            $stmt = $pdo->prepare(self::SELECT_USER_BY_ID, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return $this->fetchUser($stmt);
            }
        } finally {
            $this->disconnect();
        }
        return null;
    }

    private function fetchUser(PDOStatement $stmt): User
    {
        $user = New User();
        $user->setId($stmt->fetchColumn(0));
        $user->setUserName($stmt->fetchColumn(1));
        $user->setPassword($stmt->fetchColumn(2));
        $user->setEmail($stmt->fetchColumn(3));
        $stmt = null;
        return $user;
    }

    public function save(User $user): int
    {
        $id = -1;
        $pdo = null;
        try {
            $pdo = $this->connect();
            $pdo->beginTransaction();
            $stmt = $pdo->prepare($user->getId() > 0 ? self::UPDATE_USER : self::INSERT_NEW_USER);
            $userName = $user->getUserName();
            $email = $user->getEmail();
            $password = $user->getPassword();
            $active = $user->isActive();
            echo($userName . " " . $email . " " . $password . " " . $active);
            $stmt->bindParam(':username', $userName, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':active', $active, PDO::PARAM_BOOL);
            $id = $stmt->execute() ? $pdo->lastInsertId() : -1;
            $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
        } finally {
            $this->disconnect();
        }
        return $id;
    }

    public function delete(User $user): bool
    {
        try {
            $pdo = $this->connect();
            $stmt = $pdo->prepare(self::REMOVE_USER);
            $stmt->bindParam(':id', $user->getId(), PDO::PARAM_INT);
            return $stmt->execute();
        } finally {
            $this->disconnect();
        }
    }

    public function listAll(): array
    {
        $users = array();
        try {
            $pdo = $this->connect();
            $stmt = $pdo->prepare(self::LIST_ALL_USERS);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetchAll();
                foreach ($result as $row) {
                    $user = New User();
                    $user->setId($row['id']);
                    $user->setUserName($row['username']);
                    $user->setEmail($row['email']);
                    $user->setPassword($row['password']);
                    $user->setActive($row['active']);
                    $users[] = $user;
                }
            }
        } finally {
            $this->disconnect();
        }
        return $users;
    }

    public function getByLoginOrEmail(string $loginOrEmail, string $password): ?User
    {
        try {
            $pdo = $this->connect();
            $stmt = $pdo->prepare(self::SELECT_USER_BY_LOGIN_OR_EMAIL);
            $stmt->bindParam(':loginOrEmail', $loginOrEmail, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount() > 0 ? $this->fetchUser($stmt) : null;
        } finally {
            $this->disconnect();
        }
    }

    function isUserNameExists(string $username): bool
    {
        try {
            $pdo = $this->connect();
            $stmt = $pdo->prepare(self::IS_USERNAME_EXISTS);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->execute() && $stmt->rowCount() > 0;
        } finally {
            $this->disconnect();
        }
    }

    function isEmailExists(string $email): bool
    {
        try {
            $pdo = $this->connect();
            $stmt = $pdo->prepare(self::IS_EMAIL_EXISTS);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            return $stmt->execute()
                && $stmt->rowCount() > 0;
        } finally {
            $this->disconnect();
        }
    }
}