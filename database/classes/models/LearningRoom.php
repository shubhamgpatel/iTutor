<?php

class LearningRoom
{
    private $room_number;
    
    public function __construct($room_number)
    {
        $this->setRoomNumber($room_number);
    }

    public function setRoomNumber($value)
    {
        $this->room_number = $value;
    }

    public function getRoomNumber()
    {
        return $this->room_number;
    }
}