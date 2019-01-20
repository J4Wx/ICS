# J4Wx/ICS

Calendar and Event generator in the ICAL format.  
  
Can be output as a string or downloaded using the download function.

```
composer require j4wx/ics
```

##### Example
```php
use J4Wx\ICS\Calendar;
use J4Wx\ICS\Event;

$cal = new Calendar();

$event = new Event();
$event->setStart(new DateTime("now"));
$event->setEnd(new DateTime("tomorrow"));
$event->setSummary("Big Party");

$cal->addEvent($event);

$event = new Event();
$event->setStart(new DateTime("yesterday"));
$event->setEnd(new DateTime("today"));
$event->setSummary("Another Party");
$event->setURL("https://www.github.com/J4Wx");

$cal->addEvent($event);

$cal->download();
```

*I might write some proper documentation eventually...*