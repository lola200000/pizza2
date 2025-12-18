<?php

namespace App\DataFixtures;

use App\Entity\Pizza;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PizzaFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $pizzas = [
            [
                'name' => 'Margherita',
                'description' => 'Tomate, mozzarella, basilic frais',
                'prix' => 10.99,
                'image' => 'images/pizzas/margherita.jpg',
            ],
            [
                'name' => 'Pepperoni',
                'description' => 'Tomate, mozzarella, pepperoni épicé',
                'price' => 12.99,
                'image' => 'images/pizzas/pepperoni.jpg',
            ],
            [
                'name' => 'Végétarienne',
                'description' => 'Tomate, mozzarella, légumes frais',
                'price' => 11.99,
                'image' => 'images/pizzas/vegetarienne.jpg',
            ],
            [
                'name' => 'Quattro Formaggi',
                'description' => 'Mozzarella, gorgonzola, parmesan, chèvre',
                'price' => 13.99,
                'image' => 'images/pizzas/quattro-formaggi.jpg',
            ],
            [
                'name' => 'Hawaïenne',
                'description' => 'Tomate, mozzarella, jambon, ananas',
                'price' => 12.49,
                'image' => 'images/pizzas/hawaiienne.jpg',
            ],
            [
                'name' => 'Calzone',
                'description' => 'Pizza pliée garnie de jambon et ricotta',
                'price' => 13.49,
                'image' => 'images/pizzas/calzone.jpg',
            ],
        ];

        foreach ($pizzas as $data) {
            $pizza = new Pizza();
            $pizza->setName($data['name']);
            $pizza->setDescription($data['description']);
            $pizza->setPrice($data['price']);
            $pizza->setImage($data['image']);

            $manager->persist($pizza);
        }

        $manager->flush();
    }
}
