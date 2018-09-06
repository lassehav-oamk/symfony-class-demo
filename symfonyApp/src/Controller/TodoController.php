<?php
/**
 * Created by PhpStorm.
 * User: lassehav
 * Date: 30.8.2018
 * Time: 11.04
 */

namespace App\Controller;


use App\Entity\TodoItem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TodoController extends AbstractController
{
    public function list()
    {
        $listData = $this->getDoctrine()->getRepository(TodoItem::class)->findAll();

        return $this->render('todo/list.html.twig', array('listData' => $listData));
    }

    public function viewItem(Request $request, $itemId)
    {
        $itemData = $this->getDoctrine()->getRepository(TodoItem::class)->find($itemId);

        $form = $this->createFormBuilder($itemData)
                ->add('description', TextType::class)
                ->add('dueDate', DateType::class)
                ->add('save', SubmitType::class, array('label' => 'Save item'))
                ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $itemData = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($itemData);
            $entityManager->flush();
        }

        return $this->render('todo/viewItem.html.twig',
                            array('itemData' => $itemData,
                                  'editForm' => $form->createView()));
    }
}