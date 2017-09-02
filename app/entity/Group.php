<?php
/**
 * Created by PhpStorm.
 * User: ramos
 * Date: 02.09.2017
 * Time: 13:17
 */

namespace Entity;


class Group extends Identifier
{
    private $userId;
    private $title;
    private $imageLink;

    /**
     * @return mixed
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getImageLink(): string
    {
        return $this->imageLink;
    }

    /**
     * @param mixed $imageLink
     */
    public function setImageLink(string $imageLink)
    {
        $this->imageLink = $imageLink;
    }
}