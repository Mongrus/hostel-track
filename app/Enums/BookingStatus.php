<?php

namespace App\Enums;

enum BookingStatus: string
{
    case BOOKED = 'booked';
    case DAILY = 'daily';
    case LONGTERM = 'longterm';
}
