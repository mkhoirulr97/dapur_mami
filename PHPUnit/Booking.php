<?php

// File: Booking.php

class Booking
{
    private $event;
    private $date;
    private $time;
    private $totalGuests;
    private $menu;

    public function __construct($event, $date, $time, $totalGuests, $menu)
    {
        $this->event = $event;
        $this->date = $date;
        $this->time = $time;
        $this->totalGuests = $totalGuests;
        $this->menu = $menu;
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getTotalGuests()
    {
        return $this->totalGuests;
    }

    public function getMenu()
    {
        return $this->menu;
    }
}
