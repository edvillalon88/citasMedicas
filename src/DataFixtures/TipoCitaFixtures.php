<?php

namespace App\DataFixtures;

use App\Entity\TipoCita as EntityTipoCita;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TipoCitaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tipos = ['Consulta', 'Revision'];
        // $product = new Product();
        // $manager->persist($product);
        for($i = 0; $i < count($tipos); $i++){
            $tipo = new EntityTipoCita();
            $tipo->setNombre($tipos[$i]);
            $manager->persist($tipo);
        }
        $manager->flush();
    }
}
