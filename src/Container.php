<?php

/**
 * PSR-11 dependency container
 *
 * @license MIT <https://mit-license.org>
 * @author  Jason Napolitano
 *
 * @version 1.0.0
 */

namespace ContainerFactory {

    use ReflectionException;
    use ReflectionNamedType;
    use ReflectionParameter;
    use ReflectionUnionType;
    use ReflectionClass;

    class Container implements Contracts\ContainerInterface, Contracts\InstanceInterface
    {
        /** @var Container|null $instance Container instance */
        private static ?Container $instance = null;

        /** @var array $services Services array */
        public array $services = [];

        public function __construct()
        {
            self::$instance = $this;
        }

        /** @inheritDoc */
        public function mount(array $services = []): void
        {
            $this->services = [...$this->services, ...$services];

            foreach ($this->services as $entry => $class) {
                $this->add($entry, $class);
            }
        }

        /**
         * @inheritdoc
         */
        public function add(string $name, string|object|callable $concrete): void
        {
            $this->services[$name] = $concrete;
        }

        /** @inheritDoc */
        public function remove(string $name): void
        {
            array_splice($this->services, array_search($name, array_keys($this->services), true), 1);
        }

        /** @inheritDoc */
        public function get(string $id): mixed
        {
            if ($this->has($id)) {
                $service = $this->services[$id];

                if (is_callable($service)) {
                    return $service($this);
                }
                $id = $service;
            }
            return $this->resolve($id);
        }

        /** @inheritDoc */
        public function has(string $id): bool
        {
            return isset($this->services[$id]);
        }

        /**
         * Dependency resolver
         *
         * @param string $id
         *
         * @return mixed
         */
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

            //
            $constructor = $reflectionClass->getConstructor();

            if (!$constructor) {
                return new $id();
            }

            $parameters = $constructor->getParameters();

            if (!$parameters) {
                return new $id();
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
                },
                $parameters
            );

            return $reflectionClass->newInstanceArgs($dependencies);
        }

        /**
         * Return the current container, or NULL if no
         * instance is available
         *
         * @return self|null
         */
        public static function instance(): null|Contracts\InstanceInterface
        {
            return self::$instance;
        }

        /** @inheritdoc */
        public function reset(): void
        {
            self::$instance = new self();
        }

        /** @inheritdoc */
        public function destroy(): void
        {
            self::$instance = null;
        }
    }
}
