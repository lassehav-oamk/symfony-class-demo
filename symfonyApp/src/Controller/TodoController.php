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
use Symfony\Component\HttpFoundation\Response;

class TodoController extends AbstractController
{
    public function list(Request $request)
    {
        $newTodoItem = new TodoItem();
        $form = $this->createFormBuilder($newTodoItem)
            ->add('description', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Add new'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            $newTodoItem = $form->getData();
            $newTodoItem->setIsDone(false);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newTodoItem);
            $entityManager->flush();

            $this->redirectToRoute('todoList');
        }

        $listData = $this->getDoctrine()->getRepository(TodoItem::class)->findAll();

        return $this->render('todo/list.html.twig',
                                    array('listData' => $listData,
                                          'addNewItemForm' => $form->createView()));
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

    public function deleteItem($itemId)
    {
        $itemData = $this->getDoctrine()->getRepository(TodoItem::class)->find($itemId);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($itemData);
        $entityManager->flush();

        return new Response();
    }
}