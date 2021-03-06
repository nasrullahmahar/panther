<?php

namespace Panther\Cli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

use Symfony\Component\Filesystem\Filesystem;

class CreateEntityCommand extends Command
{
    protected function configure()
    {
        $this
        ->setName('make:entity')
        ->setDescription('Creates a new entity.');
        //->setHelp('This command allows you to create a user...');

        $this->addArgument('name', InputArgument::REQUIRED, 'Name');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Creating entity ['.$input->getArgument('name').'] ...');        

        $fileSystem = new Filesystem();

        $name = $input->getArgument('name');
        $class = \ucfirst($name).'Entity';
        $file = 'app/entities/'.$class.'.php';

        // Fetching template
        $template = file_get_contents('app/storage/templates/entity.template');
        $template = str_replace('<class_name>', $class, $template);
        $template = str_replace('<route_name>', $name, $template);

        // Generating file
        $fileSystem->dumpFile($file, $template);

        $output->writeln('Entity created successfully.');
        $output->writeln('NOTE: Remeber to register newly created entity in index.php');
    }

}