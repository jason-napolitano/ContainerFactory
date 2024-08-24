<?php

namespace ContainerFactory {

    class Factory implements Contracts\FactoryInterface
    {
        /** @inheritDoc */
        public static function __callStatic(string $name, array $arguments)
        {
            if (! array_key_exists($name, instance()?->services)) {
                throw new Exceptions\Factory\ServiceNotFound("Service '$name' not found");
            }

            return instance()?->get($name);
        }
    }
}
