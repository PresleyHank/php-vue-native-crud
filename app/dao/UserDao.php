<?php

namespace Dao;


use Entity\User;

interface UserDao
{
    function get(int $id): ?User;

    function getByLoginOrEmail(string $loginOrEmail, string $password): ?User;

    function isUserNameExists(string $username): bool;

    function isEmailExists(string $email): bool;

    function save(User $obj): int;

    function delete(User $obj): bool;

    function listAll(): array;
}