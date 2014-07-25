<?php

class AttendeeTest extends PHPUnit_Framework_TestCase {

    private $attendee;

    protected function setUp()
    {
        $this->attendee = new Attendee;
    }

    public function testSetAndGetUniqueIdWorks()
    {
        $id = '123';
        $this->attendee->setUniqueId($id);
        $this->assertEquals($id, $this->attendee->getUniqueId());
    }
    public function testSetAndGetNameWorks()
    {
        $name = 'Grabowsky';
        $this->attendee->setName($name);
        $this->assertEquals($name, $this->attendee->getName());
    }
}
 