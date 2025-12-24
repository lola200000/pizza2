<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PizzaRepository;

class OrderController extends AbstractController
{
    #[Route('/checkout', name: 'order_checkout')]
    public function checkout(SessionInterface $session, PizzaRepository $pizzaRepository): Response
    {
        $cart = $session->get('panier', []);
        $items = [];
        $total = 0;

        foreach ($cart as $pizzaId => $quantity) {
            $pizza = $pizzaRepository->find($pizzaId);
            if ($pizza) {
                $items[] = [
                    'pizza' => $pizza,
                    'quantity' => $quantity,
                ];
                $total += $pizza->getPrix() * $quantity;
            }
        }

        return $this->render('order/checkout.html.twig', [
            'items' => $items,
            'total' => $total,
        ]);
    }

    #[Route('/order', name: 'order', methods: ['POST'])]
    public function confirm(Request $request, SessionInterface $session): Response
    {
    
        $name = $request->request->get('name');
        $phone = $request->request->get('phone');
        $address = $request->request->get('address');

        


        $session->remove('panier');

        //  flash 
        $this->addFlash('success', 'Votre commande a été validée !');

        
        return $this->redirectToRoute('pizza_index');
    }
}


