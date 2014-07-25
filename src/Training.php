<?php

class Training
{
    private $title;
    private $maxAttendeesCount;
    private $attendees      = array();
    private $grades         = array();
    private $attendeesCount = 0;

    public function __construct($title, $maxAttendeesCount = 12)
    {
        if (!$title) {
            throw new Exception;
        }
        $this->title = $title;
        $this->$maxAttendeesCount = $maxAttendeesCount;
    }
    private function getAttendeeById( $id )
    {
        if (isset($this->attendees[$id]))
        {
            return $this->attendees[$id];
        }
        else {
            return null;
        }
    }

    private function hasFreeSpaces()
    {
        return $this->getAttendeesCount() <= $this->maxAttendeesCount;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function addNewAttendee( Attendee $attendee )
    {
        if ($this->getAttendeeById($attendee->getUniqueId()))
        {
            throw new Exception('Attendee is already registered with this id: ' . (string)$attendee->getUniqueId());
        }

        if ($this->hasFreeSpaces())
        {
            $this->attendees[$attendee->getUniqueId()] = $attendee;
            $this->attendeesCount++;
            return true;
        }
        else {
            throw new Exception('Sorry, we are on full, try another training');
        }
    }

    public function getAttendeesCount()
    {
        return $this->attendeesCount;
    }

    public function addGrade( $id, $gradeValue )
    {
        $this->grades[$id] = $gradeValue;
    }

    public function getGradeByAttendeeId( $id )
    {
        return $this->grades[$id];
    }

    public function getAllAttendeesData()
    {
        $result = array();
        foreach ($this->attendees as $attendee)
        {
            $id = $attendee->getUniqueId();
            $result[$attendee->getName()] = $this->getGradeByAttendeeId($id);
        };
        return $result;
    }
}