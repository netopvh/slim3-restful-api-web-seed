<?php

namespace App\Interfaces;

use Interop\Container\ContainerInterface;

/**
 * Interface ContainerAwareInterface.
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 *
 * @category Interface
 *
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 */
interface ContainerAwareInterface
{
    /**
     * Set the application dependency container instance.
     * 
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container);
}
