<?php
/**
 * Created by PhpStorm.
 * User: lassehav
 * Date: 4.9.2018
 * Time: 9.25
 */

namespace App\DataFixtures;

use App\Entity\TodoItem;
use App\Entity\User;
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

        $dummyUser = new User();
        $dummyUser->setEmail('test@test');
        $dummyUser->setUsername('tester');
        $dummyUser->setPassword(password_hash('test_password', PASSWORD_BCRYPT));
        $manager->persist($dummyUser);

        $dummyUser2 = new User();
        $dummyUser2->setEmail('test2@test');
        $dummyUser2->setUsername('tester2');
        $dummyUser2->setPassword(password_hash('test_password2', PASSWORD_BCRYPT));
        $manager->persist($dummyUser2);

        $manager->flush();
    }
}