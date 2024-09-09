<?php

namespace Tests\Feature {

    use ContainerFactory\Contracts;
    use Tests\Libraries\DemoService;
    use function ContainerFactory\{container, instance};

    describe('container', function () {

        test('new container and container instance have successfully been created', function () {
            container(function ($instance) {
                // $instance->mount([ ... ])
                expect($instance)
                    ->toBeInstanceOf(Contracts\ContainerInterface::class)
                    ->and(instance())
                    ->toBeInstanceOf(Contracts\ContainerInterface::class);
            });
        });

        test('container instance can have services mounted to it using mount()', function () {
            instance()?->mount([
                'demo' => DemoService::class
            ]);
            expect(instance()->services)->toHaveKey('demo', DemoService::class);
        });

        test('services that have not been mounted to the container cannot be called', function () {
            expect(instance()->services)->not()->toHaveKey('serviceThatDoesNotExist');
        });

        test('an existing container instance can be reset using reset()', function () {
            instance()?->reset();
            expect(instance()->services)->not()->toHaveKey('demo');
        });

        test('an existing container instance can be destroyed using destroy()', function () {
            instance()?->destroy();
            expect(instance())->toBeNull();
        });

        // test('test description)', function () {

        // });
    })->group('container');
}
