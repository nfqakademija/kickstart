<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    public function onEasyAdminPreUpdate(GenericEvent $event)
    {
        $user = $event->getArgument('entity');
        $em = $event->getArgument('em');
        if (($user instanceof User) && ($em instanceof EntityManager) && $user->isPasswordWasChanged()) {
            $user->setPasswordChanged(new \DateTime());
            $em->persist($user);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
           EasyAdminEvents::PRE_UPDATE => 'onEasyAdminPreUpdate',
        ];
    }
}
