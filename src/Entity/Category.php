<?php

namespace App\Entity;

class Category
{
    private $id;

    private $name;

    private $childIds;

    private $childName;

    /**
     * @return mixed
     */
    public function getChildName()
    {
        $completeName = explode(' / ', $this->getName());
        if (isset($completeName[1])) {
            $childName = $completeName[1];
        } else {
            $childName = $completeName[0];
        }
        $this->childName = $childName;
        return $this->childName;
    }

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
