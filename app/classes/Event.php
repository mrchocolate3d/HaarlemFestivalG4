<?php

namespace Classes;

use DateTime;

abstract class Event
{
    private int $eventId;
    // private string $name;
    // private string $category; // Category is the class name of the child class
    private DateTime $startDateTime;
    private DateTime $EndDateTime;

    public function __construct(int $eventId, DateTime $startDateTime, DateTime $endDateTime) 
    {
        $this->eventId = $eventId;
        $this->startDateTime = $startDateTime;
        $this->endDateTime = $endDateTime;
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}
