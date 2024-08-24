<?php

use ContainerFactory\Contracts;
use ContainerFactory\Factory;
use Tests\Libraries\DemoService;
use function ContainerFactory\{container, factory, instance};

describe('facade', function () {

    test('facade class generates static methods which call services mounted to the container', function () {
        container(function (Contracts\ContainerInterface $container) {
            $container->mount([
	            'demoService' => \Tests\Libraries\DemoService::class,
            ]);
        });

        expect(Factory::demoService())->toBeInstanceOf(DemoService::class);
    });

    test('facade class can access methods within mounted service classes', function () {
        /** @var DemoService $demo */
        $demo = Factory::demoService();

        expect($demo->get())->toBe('hello, world!');
    });

    test('facade function can access methods within mounted service classes', function () {
        /** @var DemoService $demo */
        $demo = factory('demoService');

        expect($demo->get())->toBe('hello, world!');
    });

	test('facade function can return the value of a function that\'s been used as a callback', function () {
		instance()?->mount([
			'version' => fn() => '1.0.12',
		]);

		expect(factory('version'))->toBe('1.0.12');
	});

	test('facade function can call a method from a service classes parent class', function () {
		expect(instance()?->get('demoService')->parentMessage())->toBe('I am coming from the parent class!');
	});


	test('facade function can call a property from a service classes parent class', function () {
		expect(instance()?->get('demoService')->property)->toBe('property value');
	});

	test('facade function can call a method from a trait being used in the service class', function () {
		expect(factory('demoService')->traitMessage())->toBe('I am coming from a trait!');
	});

	test('facade function can call a property from a trait being used in the service class', function () {
		expect(factory('demoService')->message)->toBe('property message');
	});

})->group('facade');
