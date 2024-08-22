<?php

/**
 * Container contract
 *
 * @license MIT <https://mit-license.org>
 * @author  Jason Napolitano
 *
 * @version 1.0.0
 */

namespace ContainerFactory\Contracts {

    interface ContainerInterface extends \Psr\Container\ContainerInterface
    {
        /**
         * Mount new services to the container
         *
         * @param array $services
         *
         * @return void
         */
        public function mount(array $services = []): void;

	    public function destroy(): void;

	    public function reset(): void;
    }
}
