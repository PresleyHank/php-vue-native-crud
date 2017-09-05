<?php


namespace Dao;


use Entity\Group;

interface GroupDao
{
    function get(int $id): string;

    function save(Group $obj): int;

    function delete(int $groupId): bool;

    function listAllByUser(int $userId): string;

    function listAll(): string;
}