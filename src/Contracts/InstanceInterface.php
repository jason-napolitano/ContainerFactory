<?php

namespace ContainerFactory\Contracts {

    interface InstanceInterface extends ContainerInterface
    {
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
