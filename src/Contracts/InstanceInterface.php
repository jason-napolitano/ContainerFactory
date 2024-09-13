<?php

namespace ContainerFactory\Contracts {

    interface InstanceInterface extends ContainerInterface
    {
        /**
         * Add a new service to the container
         *
         * @param string                 $name
         * @param string|object|callable $concrete
         *
         * @return void
         */
        public function add(string $name, string|object|callable $concrete): void;

        /**
         * Remove a service from the container
         *
         * @param string $name
         *
         * @return void
         */
        public function remove(string $name): void;

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
