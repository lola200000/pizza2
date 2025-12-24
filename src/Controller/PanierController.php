<?php

namespace App\Controller;

use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'panier_index')]
    public function index(SessionInterface $session, PizzaRepository $pizzaRepository): Response
    {
        $cart = $session->get('panier', []);
        $items = [];
        $total = 0;

        foreach ($cart as $id => $quantity) {
            $pizza = $pizzaRepository->find($id);
            if ($pizza) {
                $items[] = [
                    'pizza' => $pizza,
                    'quantity' => $quantity,
                ];
                $total += $pizza->getPrix() * $quantity;
            }
        }

        return $this->render('panier/index.html.twig', [
            'items' => $items,
            'total' => $total,
        ]);
    }

    #[Route('/panier/add/{id}', name: 'panier_add')]
    public function add(int $id, SessionInterface $session): Response
    {
        $cart = $session->get('panier', []);
        $cart[$id] = ($cart[$id] ?? 0) + 1;
        $session->set('panier', $cart);

        return $this->redirectToRoute('panier_index');
    }

    #[Route('/panier/decrease/{id}', name: 'panier_decrease')]
    public function decrease(int $id, SessionInterface $session): Response
    {
        $cart = $session->get('panier', []);
        if (isset($cart[$id])) {
            $cart[$id]--;
            if ($cart[$id] <= 0) {
                unset($cart[$id]);
            }
            $session->set('panier', $cart);
        }

        return $this->redirectToRoute('panier_index');
    }

    #[Route('/panier/remove/{id}', name: 'panier_remove')]
    public function remove(int $id, SessionInterface $session): Response
    {
        $cart = $session->get('panier', []);
        unset($cart[$id]);
        $session->set('panier', $cart);

        return $this->redirectToRoute('panier_index');
    }
}
