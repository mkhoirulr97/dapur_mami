<?php

// File: BookingTest.php

use PHPUnit\Framework\TestCase;

class BookingTest extends TestCase
{
    public function testBookingDetails()
    {
        $event = 'ulang Tahun';
        $date = '2023-06-15';
        $time = '16:00';
        $totalGuests = 10;
        $menu = 'Nasi Goreng';

        $booking = new Booking($event, $date, $time, $totalGuests, $menu);

        $this->assertEquals($event, $booking->getEvent());
        $this->assertEquals($date, $booking->getDate());
        $this->assertEquals($time, $booking->getTime());
        $this->assertEquals($totalGuests, $booking->getTotalGuests());
        $this->assertEquals($menu, $booking->getMenu());
    }
}
