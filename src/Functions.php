<?php

/**
 * These helper functions provide a procedural
 * API which has access the container and its
 * properties.
 *
 * @license MIT <https://mit-license.org>
 * @author  Jason Napolitano
 *
 * @version 1.0.0
 */

namespace ContainerFactory {

    /**
     * Create a new container instance
     *
     * @param callable|null $callable A callback returning a new container
     *                                instance
     *
     * @return void
     */
    function container(callable $callable = null): void
    {
        $callable ? $callable(new Container()) : new Container();
    }

    /**
     * Return the current container instance
     *
     * @return Contracts\ContainerInterface|null
     */
    function instance(): ?Contracts\ContainerInterface
    {
        return Container::instance();
    }

    /**
     * Directly call a mounted service using the
     * facade system
     *
     * @param string $id The ID of the service
     *
     * @return mixed
     */
    function facade(string $id): mixed
    {
        return Facade::$id();
    }
}
