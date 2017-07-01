<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Order;
use AppBundle\Form\OrderType;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrdersController extends FOSRestController
{

    public function postOrdersAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $order = new Order();
        $form = $this->createForm(new OrderType($this->getDoctrine()->getManager()), $order);
        $data = $request->request->get('parameters['.$form->getName().']',null,true);

        $form->submit($data);
        if($form->isValid())
        {
            $order->calculateDiscount();
            $em->persist($order);
            $em->flush();
        }
        else
            return new JsonResponse($form->getErrors(),Response::HTTP_UNPROCESSABLE_ENTITY);

        return new JsonResponse(null,Response::HTTP_CREATED);
    }

}
