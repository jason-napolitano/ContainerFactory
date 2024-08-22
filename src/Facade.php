<?php

namespace ContainerFactory {

	use ContainerFactory\Contracts\FacadeInterface;
	use ContainerFactory\Exceptions;
	use Tests\Feature\DemoService;

	use function ContainerFactory\{
		service, instance
	};

	class Facade implements FacadeInterface
	{
		/** @inheritDoc */
		public static function __callStatic(string $name, array $arguments)
		{
			if ( ! array_key_exists($name, instance()?->services)) {
				throw new Exceptions\Facade\ServiceNotFound("Service '$name' not found");
			}

			return service($name);
		}
	}
}