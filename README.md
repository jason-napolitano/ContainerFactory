# ContainerFactory
> A PSR-11 compatible dependency container with a simple and intuitive API

#### Build your container using the `container()` function:
```php
use function ContainerFactory\container;

// you can omit the callback if you only want to
// instantiate the container and work with it
// later on using instance() (see below)
container(function (ContainerFactory\Container $container) {
    $container->mount([
        'service_key_one' => ServiceClass::class
    ]);
});
```

#### Access the current containers instance using `instance()`
```php
use function ContainerFactory\instance;

// EG: Mounting additional services to the
// container
instance()->mount(['service_key_two' => ServiceClass::class]);
```

#### Access the service class using the `service()` function
```php
use function ContainerFactory\service;

$service = service('service_key_one');

echo $service->methodName();
```

