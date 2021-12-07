<?php

namespace App\DataFixtures;

use App\Entity\EstadoCita;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EstadoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $entitys = ['Pendiente', 'Realizada', 'Cancelada'];
        // $product = new Product();
        // $manager->persist($product);
        for($i = 0; $i < count($entitys); $i++){
            $entity = new EstadoCita();
            $entity->setNombre($entitys[$i]);
            $manager->persist($entity);
        }
        $manager->flush();

    }
}
