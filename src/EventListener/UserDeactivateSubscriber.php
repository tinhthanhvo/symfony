<?php

namespace App\EventListener;

use App\Event\UserDeactivateEvent;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserDeactivateSubscriber implements EventSubscriberInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[ArrayShape([UserDeactivateEvent::NAME => "array[]"])] public static function getSubscribedEvents(): array
    {
        return [
            UserDeactivateEvent::NAME => [
                ['deactivateUser', 10],
                ['databaseCleanup', 9],
                ['logUserDeactivated', 8],
                ['sendNotification', 7],
            ],
        ];
    }

    public function deactivateUser(UserDeactivateEvent $event): void
    {
        $user = $event->getUser();
        $user->setActive(false);
        $this->entityManager->flush();
    }

    #[Pure] public function databaseCleanup(UserDeactivateEvent $event): void
    {
        $user = $event->getUser();

        //do database cleanup stuff
    }

    #[Pure] public function logUserDeactivated(UserDeactivateEvent $event): void
    {
        $user = $event->getUser();

        //log stuff
    }

    #[Pure] public function sendNotification(UserDeactivateEvent $event): void
    {
        $user = $event->getUser();

        //do notification stuff
    }
}
