<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HelloController extends AbstractController
{
    public function index()
    {
        $number = random_int(0, 100);

        return new Response(
            'This is the index response'
        );
    }

    public function hello($firstName, $lastName)
    {
        //return new Response("Hello World");
        return $this->render('hello.html.php', array('name' => $lastName));
    }

    public function test()
    {
        $dummyData = array('Banana', 'Apple', 'Orange', 'Pears', 'Cherry');

        return $this->render('test.html.php', array('data' => $dummyData));
    }

    public function twig()
    {
        $dummyData = array('Banana', 'Apple', 'Orange', 'Pears', 'Cherry');

        return $this->render('twigdemo.html.twig', array('data' => $dummyData));
    }
}