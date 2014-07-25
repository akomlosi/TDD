<?php

class Attendee
{
    private $id;
    private $name;
    public function __construct()
    {

    }
    public function setUniqueId($id)
    {
        $this->id = $id;
    }

    public function getUniqueId()
    {
        return $this->id;
    }

    public function setName($name)
    {
         $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}