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
                'image' => 'images/pizzas/Margherita.jpg',
            ],
            [
                'name' => 'Pepperoni',
                'description' => 'Tomate, mozzarella, pepperoni épicé',
                'prix' => 12.99,
                'image' => 'images/pizzas/Pepperoni.jpg',
            ],
            [
                'name' => 'Végétarienne',
                'description' => 'Tomate, mozzarella, légumes frais',
                'prix' => 11.99,
                'image' => 'images/pizzas/Vegetarienne.jpg',
            ],
            [
                'name' => 'Quattro Formaggi',
                'description' => 'Mozzarella, gorgonzola, parmesan, chèvre',
                'prix' => 13.99,
                'image' => 'images/pizzas/Quattro-formaggi.jpg',
            ],
            [
                'name' => 'Hawaïenne',
                'description' => 'Tomate, mozzarella, jambon, ananas',
                'prix' => 12.49,
                'image' => 'images/pizzas/Hawaiienne.jpg',
            ],
            [
                'name' => 'Calzone',
                'description' => 'Pizza pliée garnie de jambon et ricotta',
                'prix' => 13.49,
                'image' => 'images/pizzas/Calzone.jpg',
            ],
        ];

        foreach ($pizzas as $data) {
            $pizza = new Pizza();
            $pizza->setName($data['name']);
            $pizza->setDescription($data['description']);
            $pizza->setPrix($data['prix']);
            $pizza->setImage($data['image']);

            $manager->persist($pizza);
        }

        $manager->flush();
    }
}
