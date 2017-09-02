<?php


namespace Dao;


use Entity\Group;

interface GroupDao
{
    function get(int $id): ?Group;

    function save(Group $obj): int;

    function delete(Group $obj): bool;

    function listAllByUser(int $userId): array;

    function listAll(): string;
}