<?php

namespace eDemy\BookingBundle\Controller;

use eDemy\MainBundle\Controller\BaseController;
use eDemy\MainBundle\Event\ContentEvent;

use eDemy\BookingBundle\Entity\Booking;
use eDemy\BookingBundle\Form\BookingType;

class BookingController extends BaseController
{
    public static function getSubscribedEvents()
    {
        return self::getSubscriptions('booking', ['booking'], array(
            'edemy_booking_frontpage_lastmodified' => array('onFrontpageLastModified', 0),
            //'edemy_agenda_actividad_details' => array('onActividadDetails', 0),
        ));
    }

    public function onFrontpageLastModified(ContentEvent $event)
    {
        $booking = $this->get('doctrine.orm.entity_manager')->getRepository('eDemyBookingBundle:Booking')->findLastModified(null);
        //die(var_dump($link->getUpdated()));        
        if($booking->getUpdated()) {
            $event->setLastModified($booking->getUpdated());
        }

        return true;
    }

    public function onFrontpage(ContentEvent $event)
    {
        $entities = $this->get('doctrine.orm.entity_manager')->getRepository('eDemyBookingBundle:Booking')->findAll();

        //$likeurl = $this->getParam('likeurl');

        $this->addEventModule($event, 'index.html.twig', array(
            'mode' => $this->getParam('edemy_booking_frontpage_mode'),
            'entities' => $entities,
            //'likeurl' => $likeurl,
        ));
    }
}
