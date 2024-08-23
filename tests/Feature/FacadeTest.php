<?php

use ContainerFactory\Exceptions;
use ContainerFactory\Contracts;
use Tests\Feature\DemoService;
use ContainerFactory\Facade;

use function ContainerFactory\{
	container, facade, instance
};

describe('facade', function () {

    test('facade generates static methods which call services mounted to the container', function () {
        container(function (Contracts\ContainerInterface $container) {
            $container->mount([
                'demo' => \Tests\Feature\DemoService::class,
            ]);
        });

        expect(Facade::demo())->toBeInstanceOf(DemoService::class);
    });

    test('facade can access methods within mounted service classes using the Facade class', function () {
        /** @var DemoService $demo */
        $demo = Facade::demo();

        expect($demo->get())->toBe('hello, world!');
    });

    test('facade can access methods within mounted service classes using facade()', function () {
        /** @var DemoService $demo */
        $demo = facade('demo');

        expect($demo->get())->toBe('hello, world!');
    });

	test('facade() function successfully calls mounted service class', function () {
		$service = facade('demo');
		expect($service->get())->toBe('hello, world!');
	});

	test('facade() can return the value of a function that\'s been used as a callback', function () {
		instance()?->mount([
			'version' => fn() => '1.0.12',
		]);

		expect(facade('version'))->toBe('1.0.12');
	});
	
})->group('facade');
