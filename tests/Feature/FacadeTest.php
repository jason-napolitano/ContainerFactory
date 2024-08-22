<?php

use ContainerFactory\Exceptions;
use ContainerFactory\Container;
use Tests\Feature\DemoService;
use ContainerFactory\Facade;

use function ContainerFactory\{
	container, facade
};

describe('facade', function () {

    test('facade generates static methods which call services mounted to the container', function () {
        container(function (Container $container) {
            $container->mount([
                'demoService' => \Tests\Feature\DemoService::class,
            ]);
        });

        expect(Facade::demoService())->toBeInstanceOf(DemoService::class);
    });

    test('facade can access methods within mounted service classes using the Facade class', function () {
        /** @var DemoService $demoService */
        $demoService = Facade::demoService();

        expect($demoService->get())->toBe('hello, world!');
    });

    test('facade can access methods within mounted service classes using facade()', function () {
        /** @var DemoService $demoService */
        $demoService = facade('demoService');

        expect($demoService->get())->toBe('hello, world!');
    });
})->group('facade');
