# ContainerFactory
> Managing dependencies in PHP applications should be easy, and a container should
> be robust. With that said, I've created a PSR-11 compatible dependency 
> container in hopes of building a portable option with a simple, intuitive, and - most of 
> all - practical, accessible API.

#### Build a container :
Building a container is simple. To do so we need to call
the `container()` function. In the container, an optional 
callback can be passed which returns the container instance. 
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

#### Access the current container:
Accessing the current container instance can be done by calling
`instance()`. This function takes no arguments. The `instance()`
function allows us to interact with the container at any time.

For example; let's say we are creating a micro-framework.
We would want a portable container. We would possibly want to
instantiate the container in an apps bootstrap
process, and add dependencies to it later on.

[Go here to see our oversimplified session library](#example-library)
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

#### Access mounted dependencies:
Okay, so we've mounted a session library to our container, and we want to
access a shared instance of that library. To do this, we will simply call 
the `service()` function . This function takes one argument - the key for 
the mounted dependency - EG: `session` as we've configured in the example 
above.
```php
use function ContainerFactory\{ service };

$session = service('session');

$session->set('message', 'Your account has been created');

echo $session->get('message'); // Your account has been created
```

#### Destroying a current container:
There will be times when we may want to work with multiple 
containers, and need to destroy existing instances. This can
be accomplished using `instance()->destroy()`. Destroying a
container instance will completely reset it and all of its
properties.
```php
use function ContainerFactory\{ instance };

instance()->destroy();
```

#### Example library
<details>
  <summary>Open / Close</summary>

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
</details>





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

