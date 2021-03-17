<?php

namespace Classes;

use DateTime;

abstract class Event
{
    private int $eventId;
    private string $name;
    private string $category;
    private DateTime $startDateTime;
    private DateTime $EndDateTime;
}
