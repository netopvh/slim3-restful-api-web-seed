<?php

namespace App\Interfaces;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Interface CommandInterface
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Interface
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 */
interface CommandInterface
{

    /**
     * 
     * @return array
     */
    public function arguments(): array;

    /**
     * 
     * @return string
     */
    public function description(): string;

    /**
     * 
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed
     */
    public function handle(InputInterface $input, OutputInterface $output);

    /**
     * 
     * @return string
     */
    public function help(): string;

    /**
     * 
     * @return string
     */
    public function name(): string;

    /**
     * 
     * @return array
     */
    public function options(): array;
}
