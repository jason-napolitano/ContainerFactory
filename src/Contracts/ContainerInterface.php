<?php

namespace ContainerFactory\Contracts {

	use Psr\Container\ContainerInterface as PsrContainerInterface;

	interface ContainerInterface extends PsrContainerInterface
    {
        /**
         * Mounts a service to a container
         *
         * @param array $services
         *
         * @return void
         */
        public function mount(array $services): void;

        /**
         * Resets a container
         *
         * @return void
         */
        public function reset(): void;

        /**
         * Destroys a container
         *
         * @return void
         */
        public function destroy(): void;
    }
}
