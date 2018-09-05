<?php

namespace App\Traits;

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
    private $_container;

    /**
     * @return Interop\Container\ContainerInterface
     */
    protected function getContainer(): ContainerInterface
    {
        return $this->_container;
    }

    /**
     * @return Logger
     */
    protected function getLogger(): Logger
    {
        return $this->_container->get('logger');
    }

    /**
     * @param ContainerInterface $container
     *
     * @return $this
     */
    public function setContainer(ContainerInterface $container): self
    {
        $this->_container = $container;

        return $this;
    }
}
