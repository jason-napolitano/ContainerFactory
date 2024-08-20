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

    use Exception;
    use Psr\Container\ContainerExceptionInterface;

    class ContainerException extends Exception implements ContainerExceptionInterface
    {
    }
}
