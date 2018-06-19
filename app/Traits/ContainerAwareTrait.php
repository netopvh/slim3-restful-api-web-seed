<?php

namespace App\Traits;

use Interop\Container\ContainerInterface as Container;

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
    protected function getContainer()
    {
        return $this->_container;
    }

    /**
     * @return Monolog\Logger
     */
    protected function getLogger()
    {
        return $this->_container->get('logger');
    }

    /**
     * @param ContainerInterface $container
     *
     * @return $this
     */
    public function setContainer(Container $container)
    {
        $this->_container = $container;

        return $this;
    }
}
