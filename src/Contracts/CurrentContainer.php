<?php

namespace ContainerFactory\Contracts {

    interface CurrentContainer extends NewContainer
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
