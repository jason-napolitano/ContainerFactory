<?php

use ContainerFactory\Exceptions;
use ContainerFactory\Container;
use ContainerFactory\Facade;

use Tests\Feature\DemoService;
use function ContainerFactory\container;

describe('facade', function() {

	test('facade generates static methods which call services mounted to the container', function() {
		container(function (Container $container) {
			$container->mount([
				'demoService' => \Tests\Feature\DemoService::class,
			]);
		});

		expect(Facade::demoService())->toBeInstanceOf(DemoService::class);
	});

	test('facade can access methods within mounted service classes', function() {
		/** @var DemoService $demoService */
		$demoService = Facade::demoService();

		expect($demoService->get())->toBe('hello, world!');
	});

})->group('facade');