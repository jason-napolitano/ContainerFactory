<?php

/**
 * PSR-11 service container
 *
 * @license MIT <https://mit-license.org>
 * @author  Jason Napolitano
 *
 * @version 1.0.0
 */

namespace ContainerFactory {

	use ReflectionClass;
	use ReflectionException;
	use ReflectionNamedType;
	use ReflectionParameter;
	use ReflectionUnionType;

	class Container implements Contracts\ContainerInterface
	{
		private static ?Container $instance = null;
		public array $services = [];

		public function __construct()
		{
			self::$instance = $this;
		}

		public static function instance(): self
		{
			return self::$instance;
		}

		public function mount(array $services = []): void
		{
			$this->services = [...$this->services, ...$services];

			foreach ($this->services as $entry => $class) {
				$this->services[$entry] = $class;
			}
		}

		public function get(string $id): mixed
		{
			if ($this->has($id)) {
				$entry = $this->services[$id];

				if (is_callable($entry)) {
					return $entry($this);
				}
				$id = $entry;
			}
			return $this->resolve($id);
		}

		public function has(string $id): bool
		{
			return isset($this->services[$id]);
		}

		protected function resolve(string $id): mixed
		{
			try {
				$reflectionClass = new ReflectionClass($id);
			} catch (ReflectionException $e) {
				throw new Exceptions\Container\NotFoundException($e->getMessage(), $e->getCode(), $e);
			}

			if (!$reflectionClass->isInstantiable()) {
				throw new Exceptions\Container\ContainerException($id . '" is not instantiable');
			}
			$constructor = $reflectionClass->getConstructor();

			if (!$constructor) {
				return new $id;
			}

			$parameters = $constructor->getParameters();

			if (!$parameters) {
				return new $id;
			}

			$dependencies = array_map(
				function (ReflectionParameter $param) use ($id) {
					$name = $param->getName();
					$type = $param->getType();

					if (!$type) {
						throw new Exceptions\Container\ContainerException(
							'Failed to resolve class "' . $id . '" because param "' . $name . '" is missing a type hint'
						);
					}

					if ($type instanceof ReflectionUnionType) {
						throw new Exceptions\Container\ContainerException(
							'Failed to resolve class "' . $id . '" because of union type for param "' . $name . '"'
						);
					}

					if ($type instanceof ReflectionNamedType && !$type->isBuiltin()) {
						return $this->get($type->getName());
					}

					throw new Exceptions\Container\ContainerException(
						'Failed to resolve class "' . $id . '" because invalid param "' . $name . '"'
					);
				}, $parameters
			);

			return $reflectionClass->newInstanceArgs($dependencies);
		}
	}
}