<?php
/**
 * Created by PhpStorm.
 * User: lassehav
 * Date: 30.8.2018
 * Time: 11.04
 */

namespace App\Controller;


use App\Entity\TodoItem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TodoController extends AbstractController
{
    public function list()
    {
        $listData = $this->getDoctrine()->getRepository(TodoItem::class)->findAll();

        return $this->render('todo/list.html.twig', array('listData' => $listData));
    }

    public function viewItem($itemId)
    {
        return $this->render('todo/viewItem.html.twig');
    }
}