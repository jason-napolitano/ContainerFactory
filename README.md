# ContainerFactory
> Managing dependencies in PHP applications should be easy. Likewise, the IOC container should
> be easy to use, and robust. It shouldn't take programmatic arm twisting to mount, and access
> dependencies within an application. 
> 
> With that said, I've created a PSR-11 compatible dependency container in hopes of building a
> portable option with a simple, intuitive, and - most of all - practical, accessible API. The
> goal of this container is to give developers easy access to all their dependencies in their
> applications, without the headaches.

#### Building a container:
Building a container is simple. To do so we need to call the `container()` function. In 
the container, an optional callback can be passed which returns the container instance. 
Omitting the callback will allow a new container to be instantiated
that can be called later on using `instance()`.
```php
use function ContainerFactory\{ container };

container(function (ContainerFactory\Contracts\ContainerInterface $container) { 
    $container->mount([
        // ...
    ]);
});
```

#### Accessing the container:
Accessing the current container instance can be done by calling `instance()`. This function 
takes no arguments. The `instance()` function allows us to interact with the container at 
any time.

For example - let's say we are creating a micro-framework. We might want to implement a 
portable container. Then, we would probably want to instantiate that container in the 
apps bootstrap process, and add dependencies to it later on. [Go here to see 
our oversimplified session library](#example-library)
```php
use function ContainerFactory\{ instance };

// further up the tree a new container has been instantiated
// ...

// now, we can mount a new session library using
// instance()->mount()
instance()->mount([
    'session' => \App\Services\Session::class
]);
```

#### Accessing mounted dependencies using `service()`:
Okay, so we've mounted a session library to our container, and we want to access a shared 
instance of that library. To do this, we will simply call the `service()` function . This 
function takes one argument - the key for the mounted dependency - EG: `session` as we've 
configured in the example above.
```php
use function ContainerFactory\{ service };

$session = service('session');

$session->set('message', 'Your account has been created');

echo $session->get('message'); // Your account has been created
```

#### Accessing mounted dependencies using `Facade::class`:
Let's say we want to access our dependencies using a facade class. This
can be done by calling `Facade::serviceName()`, where `serviceName` matches
the key that has been configured for a service upon mounting it. EG: `session`,
as we've configured in the examples above.

```php
use ContainerFactory\Facade;

$session = Facade::session();

$session->set('session_key', 'an amazing value');

echo $session->get('session_key'); // an amazing value

```

#### Resetting the container:
We can easily reset the container, and all its properties. Doing
so will remove all dependencies and give us a new container object.
To do this we would call `instance()->reset()`.
```php
use function ContainerFactory\{ instance };

instance()->reset();
```

#### Destroying the container:
There will be times when we may want to destroy a container.
Destroying a container instance will completely destroy the
container object.
```php
use function ContainerFactory\{ instance };

instance()->destroy();
```

#### Example library
In the README, we use a session library as an example on how to properly
mount a dependency. out of solidarity for a clean example of what we're
doing in the tutorial, this is the amazingly robust, and complicated class
we are using.
```php
namespace App\Services;

class Session
{
    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }
    
    public function get(string $key): mixed
    {
        return $_SESSION[$key];
    }
}
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

