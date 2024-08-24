<?php

use ContainerFactory\Contracts;
use ContainerFactory\Factory;
use Tests\Libraries\DemoService;
use function ContainerFactory\{container, factory, instance};

describe('factory', function () {

    test('factory class generates static methods which call services mounted to the container', function () {
        container(function (Contracts\ContainerInterface $container) {
            $container->mount([
	            'demoService' => \Tests\Libraries\DemoService::class,
            ]);
        });

        expect(Factory::demoService())->toBeInstanceOf(DemoService::class);
    });

	test('factory function can return the value of a function that\'s been used as a callback', function () {
		instance()?->mount([
			'version' => fn() => '1.0.12',
		]);

		expect(factory('version'))->toBe('1.0.12');
	});

	test('factory function can access methods of a mounted service classes', function () {
		/** @var DemoService $demo */
		$demo = factory('demoService');

		expect($demo->get())->toBe('hello, world!');
	});

	test('factory function can access properties of a mounted service classes', function () {
		/** @var DemoService $demo */
		$demo = factory('demoService');

		expect($demo->libraryProperty)->toBe('library property value');
	});

	test('factory function can call a method from a service classes parent class', function () {
		expect(instance()?->get('demoService')->parentMessage())->toBe('I am coming from the parent class!');
	});

	test('factory function can call a property from a service classes parent class', function () {
		expect(instance()?->get('demoService')->parentProperty)->toBe('parent property value');
	});

	test('factory function can call a method from a trait being used in the service class', function () {
		expect(factory('demoService')->traitMessage())->toBe('I am coming from a trait!');
	});

	test('factory function can call a property from a trait being used in the service class', function () {
		expect(factory('demoService')->traitProperty)->toBe('trait property value');
	});

})->group('factory');
