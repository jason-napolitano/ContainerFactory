<?php

namespace Tests\Feature {

    use ContainerFactory\Contracts;
    use function ContainerFactory\{
        container, instance, service
    };

    describe('service container', function () {

        test('new container instance has successfully been created', function () {
            container(function ($instance) {
                // $instance->mount([ ... ])
                expect($instance)
                    ->toBeInstanceOf(Contracts\ContainerInterface::class)
                    ->and(instance())
                    ->toBeInstanceOf(Contracts\ContainerInterface::class);
            });
        });

        test('container can have services mounted to it using mount()', function () {
            instance()?->mount(['demo' => DemoService::class]);
            expect(instance()->services)->toHaveKey('demo', DemoService::class);
        });

        test('services that have not been mounted cannot be called', function () {
            expect(instance()->services)->not()->toHaveKey('serviceThatDoesNotExist');
        });

        test('service() function successfully calls mounted service class', function () {
            $service = service('demo');
            expect($service->get())->toBe('hello, world!');
        });

        test('an existing container can be reset using reset()', function () {
            instance()?->reset();
            expect(instance()->services)->not()->toHaveKey('demo');
        });

        test('an existing container can be destroyed using destroy()', function () {
            instance()?->destroy();
            expect(instance())->toBeNull();
        });

        // test('test description)', function () {

        // });
    })->group('container');
}
