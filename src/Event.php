<?php
namespace J4Wx\ICS;


class Event
{
    private $id;
    private $startTime;
    private $endTime;
    private $summary;
    private $description;
    private $url;
    private $location;
    private $recurrence;

    public function __construct()
    {
    }

    public function getStart()
    {
        return $this->startTime;
    }

    public function setStart(\DateTime $dateTime)
    {
        $this->startTime = $dateTime;
    }

    public function getEnd()
    {
        return $this->endTime;
    }

    public function setEnd(\DateTime $dateTime)
    {
        $this->endTime = $dateTime;
    }

    public function getSummary()
    {
        return $this->summary;
    }

    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    public function getURL()
    {
        return $this->url;
    }

    public function setURL($url)
    {
        $this->url = $url;
    }

    public function getRecurrence()
    {
        return $this->recurrence;
    }

    public function setRecurrence(Recurrence $r)
    {
        $this->recurrence = $r;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function toString()
    {
        $output[] = "BEGIN:VEVENT";
        $output[] = "UID:" . uniqid();
        $output[] = "DTSTAMP:" . $this->timeString(new \DateTime('now'));
        $output[] = "DTSTART:" . $this->timeString($this->startTime);
        $output[] = "DTEND:" . $this->timeString($this->endTime);
        $output[] = "SUMMARY:" . $this->summary;

        if ($this->location) {
            $output[] = "LOCATION:" . $this->location;
        }

        if ($this->url) {
            $output[] = "URL:" . $this->url;
        }

        if ($this->description) {
            $output[] = "DESCRIPTION:" . $this->description;
        }

        $output[] = "END:VEVENT";

        return join("\n", $output);
    }

    private function timeString(\DateTime $time)
    {
        return gmdate('Ymd\THis\Z', $time->getTimestamp());
    }

    public function validate()
    {
        return (
            !is_null($this->startTime) &&
            !is_null($this->endTime) &&
            !is_null($this->summary)
        );
    }
}