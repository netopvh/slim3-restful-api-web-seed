<?php

namespace App\Commands;

use App\Interfaces\CommandInterface;
use App\Traits\ContainerAwareTrait;
use App\Interfaces\ContainerAwareInterface;
use Interop\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AbstractCommand
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Command
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 */
abstract class AbstractCommand extends Command implements CommandInterface, ContainerAwareInterface
{

    use ContainerAwareTrait;

    /**
     * 
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct();
        
        $this->setContainer($container);
    }

    /**
     * 
     * @return void
     */
    protected function configure()
    {
        $this->setName($this->name());
        $this->setDescription($this->description());
        $this->setHelp($this->help());
        foreach ($this->arguments() as $argument) {
            if (is_array($argument) and count($argument) === 3) {
                $this->addArgument($argument[0], $argument[1], $argument[2]);
            }
        }
        foreach ($this->options() as $option) {
            if (is_array($option) and count($option) === 5) {
                $this->addOption($option[0], $option[1], $option[2], $option[3], $option[4]);
            }
        }
    }

    /**
     * 
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->handle($input, $output);
    }

}
