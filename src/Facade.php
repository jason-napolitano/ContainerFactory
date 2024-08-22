<?php

namespace ContainerFactory {

	use ContainerFactory\Exceptions;
	use ContainerFactory\Contracts;
	use Tests\Feature\DemoService;

    class Facade implements Contracts\FacadeInterface
    {
        /** @inheritDoc */
        public static function __callStatic(string $name, array $arguments)
        {
            if (! array_key_exists($name, instance()?->services)) {
                throw new Exceptions\Facade\ServiceNotFound("Service '$name' not found");
            }

            return instance()?->get($name);
        }
    }
}
