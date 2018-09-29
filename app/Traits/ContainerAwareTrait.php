<?php

namespace App\Traits;

use Illuminate\Database\Capsule\Manager;
use Interop\Container\ContainerInterface;
use Monolog\Logger;

/**
 * Trait ContainerAwareTrait.
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 *
 * @category Trait
 *
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 */
trait ContainerAwareTrait
{
    /** @var ContainerInterface */
    private $container;

    /**
     * @return ContainerInterface
     */
    protected function getContainer(): ContainerInterface
    {
        return $this->container;
    }
    
    /**
     * Explicitly fetches the database manager service from the container.
     * 
     * @return Manager
     */
    public function getDb(): Manager
    {
        return $this->container->get('db');
    }

    /**
     * Explicitly fetches the logger service from the container.
     * 
     * @return Logger
     */
    protected function getLogger(): Logger
    {
        return $this->container->get('logger');
    }
    
    // You can fetch services from your container explicitly or implicitly. You can fetch an explicit reference to the container instance from inside a Slim application route like this:

    /**
     * @param ContainerInterface $container
     *
     * @return $this
     */
    public function setContainer(ContainerInterface $container): self
    {
        $this->container = $container;

        return $this;
    }
}
