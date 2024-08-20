# ContainerFactory
> A PSR-11 compatible dependency container with a simple and intuitive API

#### Build your container using `container()`
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

#### Access the current container using `instance()`
```php
use function ContainerFactory\instance;

// EG: Mounting additional services to the
// container
instance()->mount(['service_key_two' => ServiceClass::class]);
```

#### Access the service class using `service()`
```php
use function ContainerFactory\service;

$service = service('service_key_one');

echo $service->methodName();
```
### MIT License

Copyright (c) 2024 Jason Napolitano

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

