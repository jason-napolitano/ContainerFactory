<?php

/**
 * ContainerFactory helper functions
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
     * The current container instance
     *
     * @return Contracts\ContainerInterface|null
     */
    function instance(): ?Contracts\ContainerInterface
    {
        return Container::instance();
    }

    /**
     * Directly calls a mounted service
     *
     * @param string $id The ID of the service
     *
     * @return mixed
     */
    function service(string $id): mixed
    {
        return instance()->get($id);
    }
}
