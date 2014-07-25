<?php

class TrainingTest extends PHPUnit_Framework_TestCase {

    protected $trainingTitle = 'Training1';
    protected $training;
    protected $grades = array(1, 2, 3, 4, 5);

    protected function setUp()
    {
        $this->training = new Training($this->trainingTitle);
    }

    public function testGetTrainingTitle()
    {
        $this->assertEquals($this->trainingTitle, $this->training->getTitle($this->trainingTitle));
    }

    public function testaddNewAttendee()
    {
        $attendee = $this->getMock('Attendee');
        $attendee->expects($this->any())
        ->method('getUniqueId')
        ->willReturn('123');
        $this->assertTrue($this->training->addNewAttendee($attendee));
    }

    /**
     * @expectedException Exception
     */
    public function testAssignAttendeeThatAlreadyAssignedShouldThrowException()
    {
        $attendee = $this->getMock('Attendee');
        $attendee->expects($this->any())
            ->method('getUniqueId')
            ->willReturn('123');
        $this->training->addNewAttendee($attendee);
        $this->training->addNewAttendee($attendee);
    }

    public function testGetAttendeesCountWithoutAnyAttendees()
    {
        $training = new Training($this->trainingTitle);
        $this->assertEquals(0, $training->getAttendeesCount());
    }

    public function testGetAttendeesCountAfterAssignANewOne()
    {
        $training = new Training($this->trainingTitle);
        $attendee = $this->getMock('Attendee');
        $attendee->expects($this->any())
            ->method('getUniqueId')
            ->willReturn('123'); // Should use dataProvider here?
        $training->addNewAttendee($attendee);
        $this->assertEquals(1, $training->getAttendeesCount());
    }

    /**
     * @expectedException Exception
     */
    public function testMaximumNumberOfAssignableAttendees()
    {
        for ($i=0; $i=13; $i++) {
            $newAttendee = $this->getMock('Attendee');
            $newAttendee->expects($this->any())
                ->method('setUniqueId')
                ->with($i);
            $this->training->addNewAttendee($newAttendee);
        }
    }

    public function testAssignAGradeToANewAttendee()
    {
        $attendee = $this->getMock('Attendee');
        $attendee->expects($this->any())
            ->method('getUniqueId')
            ->willReturn('999');
        $this->training->addNewAttendee($attendee);
        $this->training->addGrade($attendee->getUniqueId(), $this->grades[0]);
        $this->assertEquals($this->grades[0], $this->training->getGradeByAttendeeId($attendee->getUniqueId()));
        $this->training->addGrade($attendee->getUniqueId(), $this->grades[3]);
        $this->assertEquals($this->grades[3], $this->training->getGradeByAttendeeId($attendee->getUniqueId()));
    }

    public function testGetAllAttendeesData()
    {

        $expectedResultArray = array( 'Fred' => '5' );

        $training = new Training($this->trainingTitle);

        $attendee = $this->getMock('Attendee');

        $attendee->expects($this->any())
            ->method('getUniqueId')
            ->willReturn('1');

        $attendee->expects($this->any())
            ->method('getName')
            ->willReturn('Fred');

        $training->addNewAttendee($attendee);
        $training->addGrade($attendee->getUniqueId(), $this->grades[4]);
        $this->assertEquals($expectedResultArray, $training->getAllAttendeesData());
    }
}
 