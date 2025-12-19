<?php

namespace App\Service;

use App\Repository\PizzaRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierService
{
    private SessionInterface $session;
    private PizzaRepository $pizzaRepository;

    public function __construct(
        RequestStack $requestStack,
        PizzaRepository $pizzaRepository
    ) {
        $this->session = $requestStack->getSession();
        $this->pizzaRepository = $pizzaRepository;
    }

    public function add(int $id): void
    {
        $panier = $this->session->get('panier', []);
        $panier[$id] = ($panier[$id] ?? 0) + 1;
        $this->session->set('panier', $panier);
    }

    public function decrease(int $id): void
    {
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])) {
            $panier[$id]--;
            if ($panier[$id] <= 0) {
                unset($panier[$id]);
            }
        }

        $this->session->set('panier', $panier);
    }

    public function remove(int $id): void
    {
        $panier = $this->session->get('panier', []);
        unset($panier[$id]);
        $this->session->set('panier', $panier);
    }

    public function getFullPanier(): array
    {
        $panier = $this->session->get('panier', []);
        $panierWithData = [];

        foreach ($panier as $id => $quantity) {
            $pizza = $this->pizzaRepository->find($id);

            if ($pizza) {
                $panierWithData[] = [
                    'pizza' => $pizza,
                    'quantity' => $quantity,
                    'total' => $pizza->getPrix() * $quantity,
                ];
            }
        }

        return $panierWithData;
    }

    public function getTotal(): float
    {
        return array_sum(array_column($this->getFullPanier(), 'total'));
    }

    public function clear(): void
    {
        $this->session->remove('panier');
    }
}
