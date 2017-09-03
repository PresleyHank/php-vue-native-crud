<?php

namespace Dao;


use Entity\Group;
use Exception;
use PDO;
use PDOStatement;

class GroupDaoImpl extends AbstractDaoImpl implements GroupDao
{
    private const DB_TABLE = '`group`';

    private const SELECT_GROUP_BY_ID = 'SELECT * FROM  ' . self::DB_TABLE . ' WHERE `id`=:id;';
    private const SELECT_ALL_GROUPS = 'SELECT * FROM  ' . self::DB_TABLE . ';';
    private const SELECT_ALL_GROUPS_BY_USER_ID = 'SELECT * FROM  ' . self::DB_TABLE . ' WHERE `id_user`=:userId;';
    private const INSERT_NEW_GROUP = 'INSERT INTO ' . self::DB_TABLE . '(`id_user`, `title`, `imageLink`) 
      VALUES (:userId, :title, :imageLink);';
    private const DELETE_GROUP = 'DELETE FROM  ' . self::DB_TABLE . ' WHERE `id`=:id;';
    private const UPDATE_GROUP = 'UPDATE ' . self::DB_TABLE .
    ' SET `id_user`=:userId, `title`=:title, `imageLink`=:imageLink WHERE `id`=:id;';

    function get(int $id): ?Group
    {
        try {
            $pdo = $this->connect();
            $stmt = $pdo->prepare(self::SELECT_GROUP_BY_ID, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return $this->fetchGroup($stmt);
            }
        } finally {
            $this->disconnect();
        }
        return null;
    }

    private function fetchGroup(PDOStatement $stmt): Group
    {
        $group = New Group();
        $group->setId($stmt->fetchColumn(0));
        $group->setUserId($stmt->fetchColumn(1));
        $group->setTitle($stmt->fetchColumn(2));
        $group->setImageLink($stmt->fetchColumn(3));
        $stmt = null;
        return $group;
    }

    function save(Group $group): int
    {
        $id = -1;
        $pdo = null;
        try {
            $pdo = $this->connect();
            $pdo->beginTransaction();
            $stmt = $pdo->prepare($group->getId() > 0 ? self::UPDATE_GROUP : self::INSERT_NEW_GROUP);
            $id = $group->getId();
            $userId = $group->getUserId();
            $title = $group->getTitle();
            $imageLink = $group->getImageLink();
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':imageLink', $imageLink, PDO::PARAM_STR);
            $id = $stmt->execute() ? $pdo->lastInsertId() : -1;
            $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
        } finally {
            $this->disconnect();
        }
        return $id;
    }

    function delete(Group $group): bool
    {
        try {
            $pdo = $this->connect();
            $stmt = $pdo->prepare(self::REMOVE_USER);
            $stmt->bindParam(':id', $group->getId(), PDO::PARAM_INT);
            return $stmt->execute();
        } finally {
            $this->disconnect();
        }
    }

    function listAllByUser(int $userId): string
    {
        try {
            $pdo = $this->connect();
            $stmt = $pdo->prepare(self::SELECT_ALL_GROUPS_BY_USER_ID);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
            }
        } finally {
            $this->disconnect();
        }
        return "";
    }

    function listAll(): string
    {
        try {
            $pdo = $this->connect();
            $stmt = $pdo->prepare(self::SELECT_ALL_GROUPS);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
            }
        } finally {
            $this->disconnect();
        }
        return "";
    }
}