<?php
/**
 * Created by PhpStorm.
 * User: lassehav
 * Date: 4.9.2018
 * Time: 9.25
 */

namespace App\DataFixtures;

use App\Entity\TodoItem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TodoAppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $descriptions = array('Buy some milk',
            'Learn symfony',
            'Wash the bike',
            'Bake a cake',
            'Create input UI',
            'Receive and store data');

        for($i = 0; $i < count($descriptions); $i++)
        {
            $todoItem = new TodoItem();
            $todoItem->setDescription($descriptions[$i]);
            $todoItem->setIsDone(false);
            $todoItem->setDueDate(new \DateTime());

            $manager->persist($todoItem);
        }

        $manager->flush();
    }
}