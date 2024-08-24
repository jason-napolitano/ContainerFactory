<?php

namespace ContainerFactory\Contracts {

    interface FactoryInterface
    {
        /**
         * Calls a service class that has been loaded into the
         * container
         *
         * @param string $name
         * @param array  $arguments
         *
         * @return mixed
         */
        public static function __callStatic(string $name, array $arguments);
    }
}
