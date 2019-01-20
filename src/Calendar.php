<?php
namespace J4Wx\ICS;

class Calendar
{
    public $name = "calendar";
    private $events = [];

    public function __construct()
    {

    }

    // Events

    public function addEvent(Event $event)
    {
        if ($event->validate()) {

            $keys = array_keys($this->events);
            $event->setId(end($keys) + 1);
            $this->events[] = $event;

            return end($keys);
        } else {
            throw new \Exception();
        }
    }

    public function removeEvent($id)
    {
        unset($this->events[$id]);
    }

    public function getEvents()
    {
        return $this->events;
    }

    // Exporting & Importing

    public function download()
    {
        header('Content-Type: text/calendar; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $this->name . '.ics');
        echo $this->toString();
    }

    public function toString()
    {
        $output[] = "BEGIN:VCALENDAR";
        $output[] = "VERSION:2.0";
        $output[] = "PRODID://J4Wx//PHP ICS 1.0//EN";
        $output[] = "CALSCALE:GREGORIAN";

        foreach ($this->events as $event) {
            $output[] = $event->toString();
        }

        $output[] = "END:VCALENDAR";

        return join("\n", $output);
    }
}