<?php

namespace App\Command;

use App\Entity\TodoItem;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TodoappCheckDueItemsCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'todoapp:check-due-items';

    protected function configure()
    {
        $this
            ->setDescription('Check due items and sends email notifications')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $em = $this->getContainer()->get('doctrine')->getManager();

        $todoItems = $em->getRepository(TodoItem::class)->findAll();
        $today = new \DateTime();
        foreach ($todoItems as $t)
        {
            if($t->getDueDate() < $today)
            {
                $output->writeln("Description: " . $t->getDescription());
                $output->writeln("Due date: " . $t->getDueDate()->format('d.m.Y'));
            }
        }

        //$io->success('You have a new command! Now make it your own! Pass --help to see your options.');
    }
}
