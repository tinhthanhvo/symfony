<?php
namespace App\Controller\Api;

use App\Entity\User;
use App\Event\UserDeactivateEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class UserDeactivateController extends AbstractController
{
    private SerializerInterface $serializer;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(
        SerializerInterface $serializer,
        EventDispatcherInterface $eventDispatcher,
    ) {
        $this->serializer = $serializer;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @Route("/user/{user}", methods={"GET"}, name="api_user_detail")
     */
    public function getUserInfo(User $user): JsonResponse
    {
        $json = $this->serializer->serialize($user, 'json', []);

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/user/deactivate/{user}", methods={"POST"}, name="user_deactivate")
     */
    public function __invoke(User $user): JsonResponse
    {
        $this->eventDispatcher->dispatch(new UserDeactivateEvent($user), UserDeactivateEvent::NAME);
        $json = $this->serializer->serialize($user, 'json', []);

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }
}
