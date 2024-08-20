<?php

/**
 * Scoped error class
 *
 * @license MIT <https://mit-license.org>
 * @author  Jason Napolitano
 *
 * @version 1.0.0
 * @since   0.0.1
 */

namespace ContainerFactory\Exceptions {

    use ContainerFactory\Contracts\ErrorInterface;

    class Error extends \Error implements ErrorInterface
    {
    }
}
