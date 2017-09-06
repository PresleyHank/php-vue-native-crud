<?php

namespace Dao;


use Entity\Group;
use Exception;
use PDO;
use Util\Constants;

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

    function get(int $id): string
    {
        try {
            $pdo = $this->connect();
            $stmt = $pdo->prepare(self::SELECT_GROUP_BY_ID, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return json_encode($stmt->fetch(PDO::FETCH_ASSOC));
            }
        } catch (Exception $e) {
            $this->errorTrackingInfo(Constants::ERROR_GROUP_GET);
        } finally {
            $this->disconnect();
        }
        return "";
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
            if ($group->getId() > 0) {
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            }
            $id = $stmt->execute() ? $pdo->lastInsertId() : -1;
            $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
            $this->errorTrackingInfo(Constants::ERROR_GROUP_SAVE);
        } finally {
            $this->disconnect();
        }
        return $id;
    }

    function delete(int $groupId): bool
    {
        try {
            $pdo = $this->connect();
            $stmt = $pdo->prepare(self::DELETE_GROUP);
            $stmt->bindParam(':id', $groupId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            $this->errorTrackingInfo(Constants::ERROR_GROUP_DELETE);
        } finally {
            $this->disconnect();
        }
        return true;
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
        } catch (Exception $e) {
            $this->errorTrackingInfo(Constants::ERROR_GROUP_LIST_ALL_BY_USER);
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
        } catch (Exception $e) {
            $this->errorTrackingInfo(Constants::ERROR_GROUP_LIST_ALL);
        } finally {
            $this->disconnect();
        }
        return "";
    }
}