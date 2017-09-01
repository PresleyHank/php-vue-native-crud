<?php


namespace Entity;


abstract class Identifier
{
    private $id = -1;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}