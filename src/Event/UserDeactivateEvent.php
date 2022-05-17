<?php

namespace App\Event;

use App\Entity\User;
use JetBrains\PhpStorm\Pure;
use Symfony\Contracts\EventDispatcher\Event;

class UserDeactivateEvent extends Event
{
    public const NAME = 'user.delete';

    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    #[Pure] public function __toString(): string
    {
        return sprintf('User ID: %s', $this->user->getId());
    }
}
