<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class OrdersController extends Controller
{
    /**
     * @Route("/api/v1/orders.json", name="add")
     * @method("POST")
     */
    public function postAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        return new JsonResponse($data);
    }
}
