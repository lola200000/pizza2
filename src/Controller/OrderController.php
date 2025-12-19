<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/checkout', name: 'order_checkout')]
    public function checkout(): Response
    {
        return $this->render('order/checkout.html.twig');
    }
}
