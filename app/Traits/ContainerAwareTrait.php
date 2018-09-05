<?php

namespace App\Traits;

use Anddye\Auth\JwtAuth;
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
     * @return JwtAuth
     */
    protected function getAuth(): JwtAuth
    {
        return $this->container->get('auth');
    }

    /**
     * @return ContainerInterface
     */
    protected function getContainer(): ContainerInterface
    {
        return $this->container;
    }

    /**
     * @return Manager
     */
    public function getDb(): Manager
    {
        return $this->container->get('db');
    }

    /**
     * @return Logger
     */
    protected function getLogger(): Logger
    {
        return $this->container->get('logger');
    }

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
