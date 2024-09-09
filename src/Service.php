<?php

namespace ContainerFactory {

    class Service
    {
        /** @inheritDoc */
        public static function __callStatic(string $name, array $arguments)
        {
            if (! array_key_exists($name, instance()?->services)) {
                throw new Exceptions\Service\ServiceNotFound("Service '$name' not found");
            }

            return instance()?->get($name);
        }
    }
}
