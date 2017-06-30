<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Order;
use AppBundle\Form\OrderType;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class OrdersController extends FOSRestController
{

    public function postOrdersAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $order = new Order();
        $form = $this->createForm(new OrderType($this->getDoctrine()->getManager()), $order);
        $data = $request->request->get('parameters['.$form->getName().']',null,true);

        try
        {
            $form->submit($data);
            if($form->isValid())
            {
                $order->calculateDiscount();
                $em->persist($order);
                $em->flush();
            }
            else
                return $form->getErrorsAsString();
        }
        catch (Exception $e)
        {
            return new JsonResponse(array($e->getMessage()));
        }

        return $order;
    }

}
