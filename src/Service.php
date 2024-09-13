<?php

namespace ContainerFactory {

    use Psr\Container\ContainerExceptionInterface;
    use Psr\Container\NotFoundExceptionInterface;

    class Service
    {
        /**
         * Calls a service class that has been loaded into the
         * container
         *
         * @param string $name
         * @param array  $arguments
         *
         * @return mixed
         *
         * @throws ContainerExceptionInterface
         * @throws NotFoundExceptionInterface
         */
        public static function __callStatic(string $name, array $arguments)
        {
            if (! array_key_exists($name, instance()?->services)) {
                throw new Exceptions\Service\ServiceNotFound("Service '$name' not found");
            }

            return instance()?->get($name);
        }
    }
}
