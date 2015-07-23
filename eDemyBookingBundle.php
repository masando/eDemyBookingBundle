<?php

namespace eDemy\BookingBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class eDemyBookingBundle extends Bundle
{
    public static function getBundleName($type = null)
    {
        if ($type == null) {
            return 'eDemyBookingBundle';
        } else {
            if ($type == 'Simple') {
                return 'Booking';
            } else {
                if ($type == 'simple') {
                    return 'booking';
                }
            }
        }
    }
    public static function eDemyBundle() {
        return true;
    }
}