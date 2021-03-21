<?php

class JazzModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getTimetable()
    {
        $this->db->query("SELECT * FROM jazz_event
        JOIN event on jazz_event.event_id = event.event_id
        JOIN location on event.location_id = location.location_id
        JOIN artist on jazz_event.artist_id = artist.artist_id");
        $this->db->execute();
        $events = $this->resultToJazzEvent($this->db->resultSet("JazzEvent"));
        return $this->formatTimetable($events);
    }

    private function resultToJazzEvent($resultSet)
    {
        $events = [];
        foreach ($resultSet as $key => $value) {
            array_push(
                $events,
                new JazzEvent(
                    $value->event_id,
                    new Artist(
                        $value->artist_id,
                        $value->artist_name,
                        $value->artist_description,
                        $value->genre
                    ),
                    new Location(
                        $value->location_id,
                        $value->location_name,
                        $value->location_description,
                        $value->capacity,
                    ),
                    new DateTime($value->start_time),
                    new DateTime($value->end_time)
                )
            );
        }

        usort($events, function ($a, $b) {
            return $a->startDateTime->getTimeStamp() - $b->startDateTime->getTimeStamp();
        });

        return $events;
    }

    private function formatTimetable($events)
    {
        $timetable = [];

        foreach ($events as $key => $value) {
            $date = $value->startDateTime->format("Y-m-d");
            $location = $value->location->description;

            if (!isset($timetable[$date][$location])) {
                // Generate the timetable headers
                $timetable[$date][$location] = array($this->formatJazzHeader($value));
            }
            array_push($timetable[$date][$location], $this->formatJazzEvent($value));
        }
        return $timetable;
    }

    private function formatJazzEvent($event): string
    {

        $formattedEvent = "<section class='event jazz-event'>" .
            "<h3>" . $event->artist->name . "</h3>" .
            "<span class='time'>" . $event->startDateTime->format("H:i") .
            " - " . $event->endDateTime->format("H:i") . "</span>" . "</section>";

        return $formattedEvent;
    }

    private function formatJazzHeader($event)
    {
        $formattedHeader = "<section class='jazz-event-header'>" .
            "<h3>" . $event->artist->name . "</h3>" .
            "<span class='date'>" . $event->startDateTime->format("d-m") . "</span></section>";
            "<span class='location'>" . $event->location->description . "</span></section>";

        return $formattedHeader;
    }
}
