<?php

use Tests\Libraries\DemoService;
use ContainerFactory\Contracts;
use ContainerFactory\Service;

use function ContainerFactory\{
	container, service, instance
};

describe('service', function () {

    test('service class generates static methods which call services mounted to the container', function () {
        container(function (Contracts\ContainerInterface $container) {
            $container->mount([
                'demoService' => \Tests\Libraries\DemoService::class,
            ]);
        });

        expect(Service::demoService())->toBeInstanceOf(DemoService::class);
    });

    test('service() function can return the value of a function that\'s been used as a callback', function () {
        instance()?->mount([
            'version' => fn() => '1.0.12',
        ]);

        expect(service('version'))->toBe('1.0.12');
    });

    test('service() function can access methods of a mounted service classes', function () {
        /** @var DemoService $demo */
        $demo = service('demoService');

        expect($demo->libraryMessage())->toBe('I am coming from the library class!');
    });

    test('service() function can access properties of a mounted service classes', function () {
        /** @var DemoService $demo */
        $demo = service('demoService');

        expect($demo->libraryProperty)->toBe('library property value');
    });

    test('service() function can call a method from a service classes parent class', function () {
        expect(instance()?->get('demoService')->parentMessage())->toBe('I am coming from the parent class!');
    });

    test('service() function can call a property from a service classes parent class', function () {
        expect(instance()?->get('demoService')->parentProperty)->toBe('parent property value');
    });

    test('service() function can call a method from a trait being used in the service class', function () {
        expect(service('demoService')->traitMessage())->toBe('I am coming from a trait!');
    });

    test('service() function can call a property from a trait being used in the service class', function () {
        expect(service('demoService')->traitProperty)->toBe('trait property value');
    });
})->group('service');
