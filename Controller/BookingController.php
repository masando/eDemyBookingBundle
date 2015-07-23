<?php

namespace eDemy\BookingBundle\Controller;

use eDemy\MainBundle\Controller\BaseController;
use eDemy\MainBundle\Event\ContentEvent;
use Symfony\Component\EventDispatcher\GenericEvent;
use eDemy\MainBundle\Entity\Param;

use eDemy\BookingBundle\Entity\Booking;
use eDemy\BookingBundle\Form\BookingType;

class BookingController extends BaseController
{
    public static function getSubscribedEvents()
    {
        return self::getSubscriptions('booking', ['booking'], array(
            'edemy_mainmenu'                        => array('onBookingMainMenu', 0),
        ));
    }

    public function onBookingMainMenu(GenericEvent $menuEvent) {
        $items = array();
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $item = new Param($this->get('doctrine.orm.entity_manager'));
            $item->setName('Admin_Reservas');
            if($namespace = $this->getNamespace()) {
                $namespace .= ".";
            }
            $item->setValue($namespace . 'edemy_booking_booking_index');
            $items[] = $item;
        }

        $menuEvent['items'] = array_merge($menuEvent['items'], $items);

        return true;
    }
}
