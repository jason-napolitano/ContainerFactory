<?php

/**
 * Container exception handler
 *
 * @license MIT <https://mit-license.org>
 * @author  Jason Napolitano
 *
 * @version 1.0.0
 */

namespace ContainerFactory\Exceptions\Container {

    use Psr\Container\NotFoundExceptionInterface;

    class NotFoundException extends \Exception implements NotFoundExceptionInterface
    {
    }
}
