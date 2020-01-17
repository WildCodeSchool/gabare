<?php

namespace App\Entity;

class Category
{
    private $id;

    private $name;

    private $childIds;

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getChildIds()
    {
        return $this->childIds;
    }

    /**
     * @param mixed $childIds
     */
    public function setChildIds($childIds): void
    {
        foreach ($childIds as $childId) {
            $this->childIds[] = $childId;
        }
    }
}
