<?php

namespace App\Controller\Api;

use App\Controller\BaseController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

class DemoApiController extends BaseController
{
    /**
     * @Rest\Get("/api/demo")
     * @return Response
     */
    public function index(): Response
    {
        return $this->handleView($this->view("OK", Response::HTTP_OK));
    }
}
